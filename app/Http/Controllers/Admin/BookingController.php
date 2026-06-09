<?php

namespace App\Http\Controllers\Admin; // Namespace diperbarui ke folder Admin

use App\Http\Controllers\Controller; // Wajib import Controller utama
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Iphone;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // 1. Tampilkan Semua Data Booking
    public function index()
    {
        $bookings = Booking::with(['customer', 'iphone'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    // 2. Tampilkan Form Tambah Peminjaman
    public function create()
    {
        $customers = Customer::orderBy('nama_lengkap', 'asc')->get();
        $iphones = Iphone::where('status', 'Tersedia')->orderBy('tipe_iphone', 'asc')->get();

        return view('admin.bookings.create', compact('customers', 'iphones'));
    }

    // 3. Proses Simpan Transaksi Baru
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'iphone_id' => 'required|exists:iphones,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
        ]);

        $iphone = Iphone::findOrFail($request->iphone_id);

        $tglSewa = new \DateTime($request->tanggal_sewa);
        $tglKembali = new \DateTime($request->tanggal_kembali);
        $lamaSewa = $tglSewa->diff($tglKembali)->days;
        if ($lamaSewa <= 0) $lamaSewa = 1;

        // Simpan data (Tanpa kolom total_harga karena tidak ada di tabel database kamu)
        Booking::create([
            'customer_id' => $request->customer_id,
            'iphone_id' => $request->iphone_id,
            'tgl_sewa' => $request->tanggal_sewa,
            'tgl_kembali' => $request->tanggal_kembali,
            'total_hari' => $lamaSewa,
            'status_booking' => 'Aktif',
        ]);

        $iphone->update(['status' => 'Disewa']);

        return redirect()->route('admin.bookings.index')->with('success', 'Transaksi rental iPhone berhasil dibuat!');
    }

    // 4. Tampilkan Form Edit Total Data
    public function edit($id)
    {
        $booking = Booking::with(['customer', 'iphone'])->findOrFail($id);
        $customers = Customer::orderBy('nama_lengkap', 'asc')->get();

        $iphones = Iphone::where('status', 'Tersedia')
            ->orWhere('id', $booking->iphone_id)
            ->orderBy('tipe_iphone', 'asc')
            ->get();

        return view('admin.bookings.edit', compact('booking', 'customers', 'iphones'));
    }

    // 5. Proses Update Perubahan Data Booking
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'iphone_id' => 'required|exists:iphones,id',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
            'status_booking' => 'required|in:Aktif,Selesai,Batal',
        ]);

        $iphoneLama = Iphone::findOrFail($booking->iphone_id);
        $iphoneLama->update(['status' => 'Tersedia']);

        $tglSewa = new \DateTime($request->tanggal_sewa);
        $tglKembali = new \DateTime($request->tanggal_kembali);
        $lamaSewa = $tglSewa->diff($tglKembali)->days;
        if ($lamaSewa <= 0) $lamaSewa = 1;

        $booking->update([
            'customer_id' => $request->customer_id,
            'iphone_id' => $request->iphone_id,
            'tgl_sewa' => $request->tanggal_sewa,
            'tgl_kembali' => $request->tanggal_kembali,
            'total_hari' => $lamaSewa,
            'status_booking' => $request->status_booking
        ]);

        $iphoneBaru = Iphone::findOrFail($request->iphone_id);
        if ($request->status_booking == 'Aktif') {
            $iphoneBaru->update(['status' => 'Disewa']);
        } else {
            $iphoneBaru->update(['status' => 'Tersedia']);
        }

        return redirect()->route('admin.bookings.index')->with('info', 'Data transaksi sewa berhasil diperbarui!');
    }

    // 6. Hapus Riwayat Transaksi
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $iphone = Iphone::findOrFail($booking->iphone_id);

        if ($booking->status_booking == 'Aktif') {
            $iphone->update(['status' => 'Tersedia']);
        }

        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('error', 'Riwayat transaksi sewa berhasil dihapus!');
    }

    // 7. Tampilkan Detail Transaksi Booking
    public function show($id)
    {
        $booking = Booking::with(['customer', 'iphone'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    // 8. Menampilkan Halaman Booking (Untuk Customer di Web Depan)
    public function customerCreate($id)
    {
        // Mengambil data iPhone yang dipilih
        $iphone = Iphone::where('status', 'Tersedia')->findOrFail($id);

        // MENGGUNAKAN FACADE AUTH UNTUK MENGAMBIL USER AKTIF
        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();

        // Cari data profil Customer jika sudah ada berdasarkan nama user
        $customer = null;
        if ($user) {
            $customer = Customer::where('nama_lengkap', $user->name)->first();
        }

        return view('customer.booking', compact('iphone', 'customer'));
    }

    // 9. Proses Simpan Transaksi dari Sisi Customer (Web Depan)
    public function customerStore(Request $request, $id)
    {
        // 1. Validasi input dari form customer
        $request->validate([
            'nik' => 'required|string|min:16|max:16',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
        ]);

        // 2. Ambil data iPhone dan User Aktif
        $iphone = Iphone::where('status', 'Tersedia')->findOrFail($id);

        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();

        // 3. Update Profil Customer (karena NIK, HP, Alamat tadinya dummy saat register)
        $customer = Customer::where('nama_lengkap', $user->name)->first();
        if ($customer) {
            $customer->update([
                'nik' => $request->nik,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        } else {
            // Jaga-jaga jika customer tidak sengaja terhapus, buatkan ulang
            $customer = Customer::create([
                'nama_lengkap' => $user->name,
                'nik' => $request->nik,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);
        }

        // 4. Hitung Durasi Waktu Hari
        $tglSewa = new \DateTime($request->tanggal_sewa);
        $tglKembali = new \DateTime($request->tanggal_kembali);
        $lamaSewa = $tglSewa->diff($tglKembali)->days;
        if ($lamaSewa <= 0) $lamaSewa = 1; // Minimal sewa 1 hari

        // 5. Simpan ke database Booking
        Booking::create([
            'customer_id' => $customer->id,
            'iphone_id' => $iphone->id,
            'tgl_sewa' => $request->tanggal_sewa,
            'tgl_kembali' => $request->tanggal_kembali,
            'total_hari' => $lamaSewa,
            'status_booking' => 'Aktif',
        ]);

        // 6. Ubah status iPhone agar tidak bisa disewa orang lain
        $iphone->update(['status' => 'Disewa']);

        // 7. Lempar kembali ke Dashboard Customer dengan notifikasi sukses
        return redirect()->route('customer.dashboard')->with('success', 'Booking berhasil diajukan! Silakan datang ke toko untuk verifikasi KTP dan pengambilan unit.');
    }
}
