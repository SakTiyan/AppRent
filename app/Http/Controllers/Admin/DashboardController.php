<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iphone;
use App\Models\Customer;
use App\Models\Booking;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data statistik dasar untuk counter box
        $totalIphone = Iphone::count();
        $totalCustomer = Customer::count();
        $totalBooking = Booking::count();
        $totalPendapatan = Transaksi::sum('jumlah_bayar');

        // 2. Data Grafik: Total pendapatan per bulan di tahun berjalan
        $tahunIni = Carbon::now()->year;

        // Buat array bawaan berisi 12 angka nol (Bulan 1 sampai 12)
        $grafikPendapatan = array_fill(0, 12, 0);

        // Query database: Kelompokkan jumlah bayar berdasarkan bulan
        $pendapatanPerBulan = Transaksi::select(
            DB::raw('MONTH(tgl_bayar) as bulan'),
            DB::raw('SUM(jumlah_bayar) as total')
        )
            ->whereYear('tgl_bayar', $tahunIni)
            ->groupBy('bulan')
            ->get();

        // Masukkan hasil query ke array $grafikPendapatan
        // (bulan - 1) karena index array dimulai dari 0
        foreach ($pendapatanPerBulan as $data) {
            $grafikPendapatan[$data->bulan - 1] = $data->total;
        }

        // 3. Lempar semua data ke view dashboard.index
        return view('dashboard.index', compact(
            'totalIphone',
            'totalCustomer',
            'totalBooking',
            'totalPendapatan',
            'grafikPendapatan'
        ));
    }
}
