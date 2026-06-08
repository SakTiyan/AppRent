@extends('layouts.admin')

@section('title', 'Tambah Data Customer')

@section('content')
<div class="max-w-2xl mx-auto space-y-6" data-aos="fade-up">
    
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.customers.index') }}" class="p-2 bg-white hover:bg-gray-100 rounded-xl border border-gray-200 transition text-gray-500" title="Kembali">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Data Customer</h1>
            <p class="text-sm text-gray-500 mt-1">Daftarkan identitas pelanggan baru untuk keperluan penyewaan.</p>
        </div>
    </div>

    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.customers.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="nik" class="block text-sm font-semibold text-gray-700 mb-2">NIK (Nomor KTP)</label>
                    <input type="text" name="nik" id="nik" maxlength="16" class="w-full px-4 py-3 rounded-xl border @error('nik') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white tracking-widest font-mono" placeholder="16 Digit NIK" value="{{ old('nik') }}" required>
                    @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="no_hp" class="block text-sm font-semibold text-gray-700 mb-2">No. WhatsApp</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-400"><i class="fa-brands fa-whatsapp"></i></span>
                        <input type="text" name="no_hp" id="no_hp" class="w-full pl-10 pr-4 py-3 rounded-xl border @error('no_hp') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white" placeholder="Contoh: 08123456789" value="{{ old('no_hp') }}" required>
                    </div>
                    @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-5">
                <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap (Sesuai KTP)</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="w-full px-4 py-3 rounded-xl border @error('nama_lengkap') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white" placeholder="Masukkan nama lengkap pelanggan" value="{{ old('nama_lengkap') }}" required>
                @error('nama_lengkap') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-8">
                <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                <textarea name="alamat" id="alamat" rows="3" class="w-full px-4 py-3 rounded-xl border @error('alamat') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white resize-none" placeholder="Masukkan alamat lengkap domisili" required>{{ old('alamat') }}</textarea>
                @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('admin.customers.index') }}" class="px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-sm font-bold transition">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-blue hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 transition">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection