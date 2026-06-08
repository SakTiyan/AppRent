<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IphoneController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\CustomerController;

Route::middleware(['auth'])->group(function () {

    // Halaman Utama Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute resource kembali normal dan bersih
    Route::resource('users', UserController::class);

    // Master Data & Operasional Lainnya
    Route::resource('iphones', IphoneController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('transaksis', TransaksiController::class);
});
