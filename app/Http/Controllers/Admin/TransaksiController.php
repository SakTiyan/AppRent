<?php

namespace App\Http\Controllers\Admin; // Namespace diperbarui ke folder Admin

use App\Http\Controllers\Controller; // Wajib import Controller utama
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
        // Ambil booking yang belum dibayar
        $bookings = Booking::with(['customer', 'iphone'])
            ->whereNotIn('id', Transaksi::pluck('booking_id'))
            ->get();

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

        // HITUNG MANDIRI: total_hari dikali harga sewa iPhone
        $tagihanAsli = $booking->total_hari * $booking->iphone->harga_perhari;

        // Logika Status Pembayaran
        $status = ($request->jumlah_bayar >= $tagihanAsli) ? 'Lunas' : 'Belum Lunas';

        Transaksi::create([
            'booking_id' => $request->booking_id,
            'user_id' => Auth::id(),
            'tgl_bayar' => $request->tgl_bayar,
            'total_biaya' => $tagihanAsli,
            'jumlah_bayar' => $request->jumlah_bayar,
            'status_pembayaran' => $status,
        ]);

        // FIX: Ditambahkan prefix admin.
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

        // FIX: Ditambahkan prefix admin.
        return redirect()->route('admin.transaksis.index')->with('error', 'Riwayat pembayaran berhasil dihapus!');
    }
}
