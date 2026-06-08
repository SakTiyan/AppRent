<?php

namespace App\Http\Controllers\Admin; // 1. Namespace diperbarui ke folder Admin

use App\Http\Controllers\Controller; // 2. Wajib import Controller utama karena beda folder
use App\Models\Iphone;
use App\Models\Customer;
use App\Models\Booking;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik riil untuk counter box
        $totalIphone = Iphone::count();
        $totalCustomer = Customer::count();
        $totalBooking = Booking::count();
        $totalPendapatan = Transaksi::sum('jumlah_bayar');

        // 3. Mengarah ke folder dashboard -> file index.blade.php yang kita cek tadi
        return view('dashboard.index', compact(
            'totalIphone',
            'totalCustomer',
            'totalBooking',
            'totalPendapatan'
        ));
    }
}
