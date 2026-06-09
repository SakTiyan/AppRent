<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Customer\CustomerPanelController;
use App\Models\Iphone;

// =========================================================================
// 1. HALAMAN DEPAN / LANDING PAGE UTAMA 
// =========================================================================
Route::get('/', function () {
    $iphones = Iphone::where('status', 'Tersedia')->latest()->get();
    return view('customer.index', compact('iphones'));
})->name('landing');

// =========================================================================
// 2. FITUR LOGIN, REGISTER & LOGOUT
// =========================================================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// TAMBAHAN RUTE REGISTER
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =========================================================================
// 3. RUTE SISI CUSTOMER (Wajib Login)
// =========================================================================
Route::middleware(['auth'])->group(function () {
    // Form Pemesanan Unit
    Route::get('/pesan/{id}', [BookingController::class, 'customerCreate'])->name('customer.booking.create');
    Route::post('/pesan/{id}', [BookingController::class, 'customerStore'])->name('customer.booking.store');

    // Portal & Dashboard Akun Customer
    Route::get('/customer/dashboard', [CustomerPanelController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/customer/history', [CustomerPanelController::class, 'history'])->name('customer.history');
    Route::get('/customer/profile', [CustomerPanelController::class, 'profile'])->name('customer.profile');
    Route::post('/customer/profile', [CustomerPanelController::class, 'updateProfile'])->name('customer.profile.update');
});

// =========================================================================
// 4. RUTE SISI ADMIN (Wajib Login)
// =========================================================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('iphones', \App\Http\Controllers\Admin\IphoneController::class);
    Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class);
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class);
    Route::resource('transaksis', \App\Http\Controllers\Admin\TransaksiController::class);
});

// =========================================================================
// 5. RUTE KHUSUS KASIR (Wajib Login)
// =========================================================================
Route::middleware(['auth'])->prefix('kasir')->name('kasir.')->group(function () {
    // URL ini akan menjadi: 127.0.0.1:8000/kasir/dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Opsional: Jika kamu ingin kasir mengakses transaksi lewat URL /kasir/transaksis
    Route::resource('transaksis', \App\Http\Controllers\Admin\TransaksiController::class);
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class);
});