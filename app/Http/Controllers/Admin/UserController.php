<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware; // <-- WAJIB DI-IMPORT DI LARAVEL 11

class UserController extends Controller implements HasMiddleware // <-- WAJIB IMPLEMENTS
{
    // JURUS SAKTI LARAVEL 11: Pengganti resmi middleware constructor lama
    // JURUS SAKTI LARAVEL 11: Pengganti resmi middleware constructor lama
    public static function middleware(): array
    {
        return [
            function ($request, $next) {
                // JALUR LENGKAP: Menggunakan \Illuminate\Support\Facades\Auth
                /** @var \App\Models\User $user */
                $user = \Illuminate\Support\Facades\Auth::user();

                // Pengecekan role menggunakan variabel yang sudah dikenali
                if ($user->role !== 'admin') {
                    return redirect()->route('admin.dashboard')->with('error', 'Anda tidak memiliki hak akses ke halaman Kelola Kasir!');
                }

                return $next($request);
            }
        ];
    }

    // 1. Tampilkan Halaman Index Data Kasir
    public function index()
    {
        $kasirs = User::where('role', 'kasir')->latest()->get();
        return view('admin.users.index', compact('kasirs'));
    }

    // 2. Menampilkan Form Tambah Kasir
    public function create()
    {
        return view('admin.users.create');
    }

    // 3. Menyimpan Data Kasir Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'kasir',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Data Kasir berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit Data Kasir
    public function edit($id)
    {
        $kasir = User::findOrFail($id);
        return view('admin.users.edit', compact('kasir'));
    }

    // 5. Memproses Update Perubahan Data Kasir
    public function update(Request $request, $id)
    {
        $kasir = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $kasir->name = $request->name;
        $kasir->email = $request->email;

        if ($request->filled('password')) {
            $kasir->password = Hash::make($request->password);
        }

        $kasir->save();

        return redirect()->route('admin.users.index')->with('info', 'Data Kasir berhasil diperbarui!');
    }

    // 6. Menghapus Akun Data Kasir
    public function destroy($id)
    {
        $kasir = User::findOrFail($id);
        $kasir->delete();

        return redirect()->route('admin.users.index')->with('error', 'Data Kasir berhasil dihapus!');
    }
}
