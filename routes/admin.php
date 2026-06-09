<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IphoneController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\CustomerController;

// Membungkus seluruh akses panel agar wajib login, menggunakan prefix /admin, dan inisial rute admin.
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Halaman Utama Dashboard Admin (Membaca rute: admin.dashboard)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Resource Master Data & Operasional (Membaca rute: admin.users.index, dll)
    Route::resource('users', UserController::class);
    Route::resource('iphones', IphoneController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('transaksis', TransaksiController::class);
});
