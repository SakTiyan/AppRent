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
}
