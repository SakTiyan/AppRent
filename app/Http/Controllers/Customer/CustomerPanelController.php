<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerPanelController extends Controller
{
    // Helper untuk mengambil data profil customer berdasarkan akun login
    private function getCustomerRecord()
    {
        return Customer::where('nama_lengkap', Auth::user()->name)->first();
    }

    public function dashboard()
    {
        $customer = $this->getCustomerRecord();

        $activeRentalsCount = 0;
        $totalBookingsCount = 0;
        $bookings = collect();
        $isLate = false;
        $daysLate = 0;
        $estimatedDenda = 0;

        if ($customer) {
            $totalBookingsCount = Booking::where('customer_id', $customer->id)->count();
            $activeRentalsCount = Booking::where('customer_id', $customer->id)->where('status_booking', 'Aktif')->count();

            // Ambil transaksi aktif terbaru untuk dianalisis keterlambatannya
            $bookings = Booking::where('customer_id', $customer->id)->latest()->take(5)->get();

            foreach ($bookings as $b) {
                if ($b->status_booking === 'Aktif' && strtotime($b->tgl_kembali) < time()) {
                    $isLate = true;
                    $selisihWaktu = time() - strtotime($b->tgl_kembali);

                    // PERBAIKAN: Menggunakan fungsi ceil() bawaan PHP
                    $days = ceil($selisihWaktu / 86400);

                    if ($days > $daysLate) {
                        $daysLate = $days;
                        // Estimasi denda flat Rp 50.000 per hari terlambat
                        $estimatedDenda = $daysLate * 50000;
                    }
                }
            }
        }

        return view('customer.dashboard', compact('activeRentalsCount', 'totalBookingsCount', 'bookings', 'isLate', 'daysLate', 'estimatedDenda', 'customer'));
    }

    public function history()
    {
        $customer = $this->getCustomerRecord();
        // Cek jika profil ada, ambil riwayatnya. Jika belum, kosongkan koleksi.
        $bookings = $customer ? Booking::where('customer_id', $customer->id)->latest()->get() : collect();

        return view('customer.history', compact('bookings'));
    }

    public function profile()
    {
        $customer = $this->getCustomerRecord();
        return view('customer.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        // Proses Upload Foto
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profiles'), $filename);

            // Hapus foto lama di folder jika ada
            if ($user->foto_profil && file_exists(public_path('uploads/profiles/' . $user->foto_profil))) {
                unlink(public_path('uploads/profiles/' . $user->foto_profil));
            }

            $user->foto_profil = $filename;
        }

        // Update Data User
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return back()->with('success', 'Data Profil & Akun berhasil diperbarui!');
    }
}
