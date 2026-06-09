@extends('layouts.admin')

@section('title', 'Detail iPhone')

@section('content')
<div class="max-w-4xl mx-auto space-y-6" data-aos="fade-up">
    
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.iphones.index') }}" class="p-2 bg-white dark:bg-slate-900 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-800 transition text-gray-500 dark:text-slate-400" title="Kembali">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Detail Unit iPhone</h1>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Informasi lengkap spesifikasi dan status unit.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col md:flex-row gap-8 transition-colors duration-300">
        <div class="w-full md:w-1/3">
            <div class="aspect-[4/5] rounded-2xl bg-gray-50 dark:bg-slate-950/50 border border-gray-100 dark:border-slate-800 flex items-center justify-center overflow-hidden shadow-inner">
                @if($iphone->gambar && file_exists(public_path('uploads/iphones/' . $iphone->gambar)))
                    <img src="{{ asset('uploads/iphones/' . $iphone->gambar) }}" alt="Gambar iPhone" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                @else
                    <i class="fa-solid fa-mobile-screen text-6xl text-gray-300 dark:text-slate-600"></i>
                @endif
            </div>
        </div>

        <div class="w-full md:w-2/3 space-y-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $iphone->tipe_iphone }}</h2>
                <div class="mt-3 inline-flex items-center gap-2">
                    @if($iphone->status == 'Tersedia')
                        <span class="px-4 py-1.5 bg-green-50 dark:bg-emerald-500/10 text-green-600 dark:text-emerald-400 rounded-full text-sm font-bold uppercase tracking-wide">Tersedia</span>
                    @elseif($iphone->status == 'Disewa')
                        <span class="px-4 py-1.5 bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded-full text-sm font-bold uppercase tracking-wide">Disewa</span>
                    @else
                        <span class="px-4 py-1.5 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 rounded-full text-sm font-bold uppercase tracking-wide">Maintenance</span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 pt-6 border-t border-gray-100 dark:border-slate-800">
                <div>
                    <p class="text-sm text-gray-400 dark:text-slate-500 font-medium mb-1">Kapasitas Penyimpanan</p>
                    <p class="text-xl font-semibold text-gray-800 dark:text-white">{{ $iphone->kapasitas }} GB</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 dark:text-slate-500 font-medium mb-1">Warna Unit</p>
                    <p class="text-xl font-semibold text-gray-800 dark:text-white capitalize">{{ $iphone->warna }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 dark:text-slate-500 font-medium mb-1">Tarif Struk Harian</p>
                    <p class="text-2xl font-bold text-brand-blue">Rp {{ number_format($iphone->harga_perhari, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-400 dark:text-slate-500 font-medium mb-1">Tanggal Terdaftar</p>
                    <p class="text-base font-semibold text-gray-800 dark:text-white">{{ $iphone->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <div class="pt-6 flex items-center gap-3 border-t border-gray-100 dark:border-slate-800">
                <a href="{{ route('admin.iphones.edit', $iphone->id) }}" class="px-6 py-3 bg-brand-amber hover:bg-yellow-500 text-white rounded-xl text-sm font-bold shadow-lg shadow-amber-500/30 transition flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square"></i> Edit Spesifikasi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection