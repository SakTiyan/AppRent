@extends('layouts.admin')

@section('title', 'Tambah Data Kasir')

@section('content')
<div class="max-w-2xl mx-auto space-y-6" data-aos="fade-up">
    
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.users.index') }}" class="p-2 bg-white hover:bg-gray-100 rounded-xl border border-gray-200 transition text-gray-500" title="Kembali">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Kasir Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Buat akun akses baru untuk staf operasional kasir.</p>
        </div>
    </div>

    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-3 rounded-xl border @error('name') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-3 rounded-xl border @error('email') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white" placeholder="contoh@apprent.com" value="{{ old('email') }}" required>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-8">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi Akses</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-3 rounded-xl border @error('password') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white" placeholder="Minimal 6 karakter" required>
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('admin.users.index') }}" class="px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-sm font-bold transition">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-blue hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 transition">Simpan Akun</button>
            </div>
        </form>
    </div>
</div>
@endsection