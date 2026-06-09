<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // 1. Tampilkan riwayat pembayaran
    public function index()
    {
        $transaksis = Transaksi::with(['booking.customer', 'user'])->latest()->get();
        return view('admin.transaksis.index', compact('transaksis'));
    }

    // 2. Form tambah pembayaran
    public function create()
    {
        // Ambil semua booking yang statusnya masih Aktif
        $allBookings = Booking::with(['customer', 'iphone'])->where('status_booking', 'Aktif')->get();

        $bookings = [];
        foreach ($allBookings as $b) {
            // Hitung total biaya asli dari lama sewa
            $totalOriginal = $b->total_hari * $b->iphone->harga_perhari;

            // Hitung akumulasi nominal yang sudah pernah dibayar sebelumnya
            $sudahDibayar = Transaksi::where('booking_id', $b->id)->sum('jumlah_bayar');

            // Hitung sisa tagihan riil saat ini
            $sisaTagihan = $totalOriginal - $sudahDibayar;

            // Jika masih ada sisa tagihan, masukkan ke dalam antrean dropdown
            if ($sisaTagihan > 0) {
                $b->sisa_tagihan = $sisaTagihan; // Menambahkan properti dinamis baru ke objek booking
                $bookings[] = $b;
            }
        }

        return view('admin.transaksis.create', compact('bookings'));
    }

    // 3. Proses simpan pembayaran
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'tgl_bayar' => 'required|date',
            'jumlah_bayar' => 'required|numeric|min:0',
        ]);

        $booking = Booking::with('iphone')->findOrFail($request->booking_id);

        // Hitung total tagihan original dari awal peminjaman
        $tagihanOriginal = $booking->total_hari * $booking->iphone->harga_perhari;

        // Cek total pembayaran lama di database
        $sudahDibayarSebelumnya = Transaksi::where('booking_id', $request->booking_id)->sum('jumlah_bayar');

        // Gabungkan pembayaran lama dengan input bayar yang baru
        $totalAkumulasi = $sudahDibayarSebelumnya + $request->jumlah_bayar;

        // Logika penentuan status berdasarkan akumulasi dana masuk
        if ($totalAkumulasi <= 0) {
            $status = 'pending';
        } elseif ($totalAkumulasi < $tagihanOriginal) {
            $status = 'Belum Lunas';
        } else {
            $status = 'Lunas';
        }

        // Simpan data pembayaran saat ini ke database
        Transaksi::create([
            'booking_id' => $request->booking_id,
            'user_id' => Auth::id(),
            'tgl_bayar' => $request->tgl_bayar,
            'total_biaya' => $tagihanOriginal, // Tetap grand total awal untuk arsip nota
            'jumlah_bayar' => $request->jumlah_bayar, // Nominal uang tunai yang masuk saat ini
            'status_pembayaran' => $status,
        ]);

        return redirect()->route('admin.transaksis.index')->with('success', 'Pembayaran berhasil diproses!');
    }

    // 4. Lihat Nota
    public function show($id)
    {
        $transaksi = Transaksi::with(['booking.customer', 'booking.iphone', 'user'])->findOrFail($id);
        return view('admin.transaksis.show', compact('transaksi'));
    }

    // 5. Hapus Riwayat
    public function destroy($id)
    {
        Transaksi::findOrFail($id)->delete();
        return redirect()->route('admin.transaksis.index')->with('error', 'Riwayat pembayaran berhasil dihapus!');
    }
}
