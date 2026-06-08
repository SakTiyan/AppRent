@extends('layouts.admin')

@section('title', 'Tambah Data iPhone')

@section('content')
<div class="max-w-2xl mx-auto space-y-6" data-aos="fade-up">
    
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.iphones.index') }}" class="p-2 bg-white hover:bg-gray-100 rounded-xl border border-gray-200 transition text-gray-500" title="Kembali">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Unit iPhone</h1>
            <p class="text-sm text-gray-500 mt-1">Masukkan data unit gadget baru yang siap disewakan.</p>
        </div>
    </div>

    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.iphones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="tipe" class="block text-sm font-semibold text-gray-700 mb-2">Tipe iPhone</label>
                    <input type="text" name="tipe" id="tipe" class="w-full px-4 py-3 rounded-xl border @error('tipe') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white" placeholder="Contoh: iPhone 15 Pro Max" value="{{ old('tipe') }}" required>
                    @error('tipe') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="kapasitas" class="block text-sm font-semibold text-gray-700 mb-2">Kapasitas (Format Angka GB)</label>
                    <input type="number" name="kapasitas" id="kapasitas" class="w-full px-4 py-3 rounded-xl border @error('kapasitas') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white" placeholder="Contoh: 128 / 256" value="{{ old('kapasitas') }}" required>
                    @error('kapasitas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="warna" class="block text-sm font-semibold text-gray-700 mb-2">Warna Unit</label>
                    <input type="text" name="warna" id="warna" class="w-full px-4 py-3 rounded-xl border @error('warna') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white" placeholder="Contoh: Black Titanium" value="{{ old('warna') }}" required>
                    @error('warna') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="harga_per_hari" class="block text-sm font-semibold text-gray-700 mb-2">Harga Sewa Per Hari</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400 font-semibold text-sm">Rp</span>
                        <input type="number" name="harga_per_hari" id="harga_per_hari" class="w-full pl-12 pr-4 py-3 rounded-xl border @error('harga_per_hari') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white font-semibold text-gray-800" placeholder="Contoh: 150000" value="{{ old('harga_per_hari') }}" required>
                    </div>
                    @error('harga_per_hari') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-8">
                <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">Foto / Gambar iPhone</label>
                <input type="file" name="gambar" id="gambar" class="w-full px-4 py-2.5 rounded-xl border @error('gambar') border-red-400 @else border-gray-200 @enderror bg-gray-50 text-sm file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-blue file:text-white hover:file:bg-blue-700 transition-all outline-none">
                <p class="text-xs text-gray-400 mt-2">*Format file wajib gambar (jpg, png, jpeg), maksimal 2MB.</p>
                @error('gambar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('admin.iphones.index') }}" class="px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-sm font-bold transition">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-blue hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 transition">Simpan Unit</button>
            </div>
        </form>
    </div>
</div>
@endsection