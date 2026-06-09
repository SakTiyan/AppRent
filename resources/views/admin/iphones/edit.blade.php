@extends('layouts.admin')

@section('title', 'Edit Data iPhone')

@section('content')
<div class="max-w-2xl mx-auto space-y-6" data-aos="fade-up">
    
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.iphones.index') }}" class="p-2 bg-white dark:bg-slate-900 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-800 transition text-gray-500 dark:text-slate-400" title="Kembali">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Data iPhone</h1>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Ubah spesifikasi, tarif sewa, status ketersediaan, atau perbarui foto unit.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 transition-colors duration-300">
        <form action="{{ route('admin.iphones.update', $iphone->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="tipe" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Tipe iPhone</label>
                    <input type="text" name="tipe" id="tipe" class="w-full px-4 py-3 rounded-xl border @error('tipe') border-red-400 dark:border-red-500 @else border-gray-200 dark:border-slate-700 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 dark:bg-slate-950/50 focus:bg-white dark:focus:bg-slate-900 text-gray-800 dark:text-white" value="{{ old('tipe', $iphone->tipe_iphone) }}" required>
                    @error('tipe') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="kapasitas" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Kapasitas (GB)</label>
                    <input type="number" name="kapasitas" id="kapasitas" class="w-full px-4 py-3 rounded-xl border @error('kapasitas') border-red-400 dark:border-red-500 @else border-gray-200 dark:border-slate-700 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 dark:bg-slate-950/50 focus:bg-white dark:focus:bg-slate-900 text-gray-800 dark:text-white" value="{{ old('kapasitas', $iphone->kapasitas) }}" required>
                    @error('kapasitas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="warna" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Warna Unit</label>
                    <input type="text" name="warna" id="warna" class="w-full px-4 py-3 rounded-xl border @error('warna') border-red-400 dark:border-red-500 @else border-gray-200 dark:border-slate-700 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 dark:bg-slate-950/50 focus:bg-white dark:focus:bg-slate-900 text-gray-800 dark:text-white" value="{{ old('warna', $iphone->warna) }}" required>
                    @error('warna') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="harga_per_hari" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Harga Sewa / Hari</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-400 dark:text-slate-500 font-semibold text-sm">Rp</span>
                        <input type="number" name="harga_per_hari" id="harga_per_hari" class="w-full pl-12 pr-4 py-3 rounded-xl border @error('harga_per_hari') border-red-400 dark:border-red-500 @else border-gray-200 dark:border-slate-700 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 dark:bg-slate-950/50 focus:bg-white dark:focus:bg-slate-900 font-semibold text-gray-800 dark:text-white" value="{{ old('harga_per_hari', $iphone->harga_perhari) }}" required>
                    </div>
                    @error('harga_per_hari') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-5">
                <label for="status" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Status Ketersediaan</label>
                <select name="status" id="status" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-slate-700 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 dark:bg-slate-950/50 focus:bg-white dark:focus:bg-slate-900 font-medium text-gray-700 dark:text-slate-300">
                    <option value="Tersedia" {{ $iphone->status == 'Tersedia' ? 'selected' : '' }}>🟢 Tersedia</option>
                    <option value="Disewa" {{ $iphone->status == 'Disewa' ? 'selected' : '' }}>🟡 Sedang Disewa</option>
                    <option value="Maintenance" {{ $iphone->status == 'Maintenance' ? 'selected' : '' }}>🔴 Maintenance / Rusak</option>
                </select>
            </div>

            <div class="mb-8">
                <label for="gambar" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Ganti Foto Gambar iPhone</label>
                @if($iphone->gambar && file_exists(public_path('uploads/iphones/' . $iphone->gambar)))
                    <div class="mb-4 flex items-center gap-3 p-3 bg-gray-50 dark:bg-slate-950/50 rounded-xl border border-gray-200 dark:border-slate-700 max-w-xs">
                        <img src="{{ asset('uploads/iphones/' . $iphone->gambar) }}" alt="Foto Lama" class="w-16 h-16 rounded-lg object-cover shadow-sm">
                        <div>
                            <span class="text-xs font-bold text-gray-700 dark:text-slate-300 block">Gambar Saat Ini</span>
                            <span class="text-[10px] text-gray-400 dark:text-slate-500 truncate block max-w-[150px]">{{ $iphone->gambar }}</span>
                        </div>
                    </div>
                @endif
                <input type="file" name="gambar" id="gambar" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-950/50 dark:text-slate-300 text-sm file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-brand-blue file:text-white hover:file:bg-blue-700 transition-all outline-none">
                <p class="text-xs text-gray-400 dark:text-slate-500 mt-2">*Kosongkan jika tidak ingin mengganti gambar unit.</p>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 dark:border-slate-800 pt-6">
                <a href="{{ route('admin.iphones.index') }}" class="px-5 py-3 bg-gray-100 dark:bg-slate-800 hover:bg-gray-200 dark:hover:bg-slate-700 text-gray-600 dark:text-slate-300 rounded-xl text-sm font-bold transition">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-blue hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection