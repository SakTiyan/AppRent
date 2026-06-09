<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= LOGIN ================= //
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // PISAHKAN JALUR: Jika yang login adalah Admin
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Berhasil Login sebagai Admin!');
            }
            // PISAHKAN JALUR: Jika yang login adalah Kasir
            elseif (Auth::user()->role === 'kasir') {
                return redirect()->intended(route('kasir.dashboard'))->with('success', 'Berhasil Login sebagai Staf!');
            }
            // PISAHKAN JALUR: Jika yang login adalah Customer Umum
            else {
                if ($request->session()->has('url.intended')) {
                    return redirect()->intended()->with('success', 'Silakan lanjutkan pemesanan Anda.');
                }
                return redirect()->route('customer.dashboard')->with('success', 'Berhasil Login! Selamat datang di AppRent.');
            }
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    // ================= REGISTER ================= //
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // 1. Buat akun sistem (users)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        // 2. SINKRONISASI JURUS SAKTI: Otomatis buatkan profil di tabel 'customers'
        Customer::create([
            'nama_lengkap' => $request->name,
            'nik' => 'BELUM_DIISI_' . rand(1000, 9999), // Dummy NIK agar tidak melanggar aturan required
            'no_hp' => 'Belum Diisi',
            'alamat' => 'Belum Diisi',
        ]);

        // Langsung auto-login
        Auth::login($user);

        if ($request->session()->has('url.intended')) {
            return redirect()->intended()->with('success', 'Pendaftaran berhasil! Silakan lanjutkan pesanan Anda.');
        }

        // Otomatis lempar ke halaman Dashboard Customer
        return redirect()->route('customer.dashboard')->with('success', 'Pendaftaran berhasil! Akun Anda siap digunakan.');
    }

    // ================= LOGOUT ================= //
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil Logout!');
    }
}
