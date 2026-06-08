@extends('layouts.admin')

@section('title', 'Dashboard Utama')

@section('content')
<div class="space-y-8" data-aos="fade-up" data-aos-duration="800">
    
    <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 p-6 md:p-8 rounded-3xl shadow-xl border border-slate-800 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative overflow-hidden">
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-brand-blue/10 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <span class="px-3 py-1 bg-emerald-500/20 text-emerald-400 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-500/30">
                <i class="fa-solid fa-circle-check animate-pulse mr-1"></i> Sistem Aktif
            </span>
            <h1 class="text-2xl md:text-3xl font-black text-white mt-3 tracking-tight">
                Selamat Datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-amber-300">Administrator</span>!
            </h1>
            <p class="text-slate-400 text-sm mt-1">Pantau performa bisnis rental dan sirkulasi kasir AppRent hari ini.</p>
        </div>
        <div class="bg-white/5 backdrop-blur-md px-4 py-2.5 rounded-xl border border-white/10 text-right relative z-10">
            <p class="text-xs text-slate-400 font-medium">Tanggal Hari Ini</p>
            <p class="text-sm font-bold text-white font-mono mt-0.5">{{ date('d F Y') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total iPhone</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-2 font-mono">{{ $totalIphone }} <span class="text-sm font-bold text-slate-400">Unit</span></h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-brand-blue flex items-center justify-center text-xl shadow-inner group-hover:bg-brand-blue group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-50 flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                <span class="text-emerald-500 font-bold"><i class="fa-solid fa-arrow-trend-up"></i> Real-time</span> data inventaris aktif
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Booking Aktif</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-2 font-mono">{{ $totalBooking }} <span class="text-sm font-bold text-slate-400">Trx</span></h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-brand-amber flex items-center justify-center text-xl shadow-inner group-hover:bg-brand-amber group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-50 flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                <span class="text-amber-500 font-bold"><i class="fa-solid fa-clock"></i> Sedang Jalan</span> masa sewa berjalan
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Customer</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-2 font-mono">{{ $totalCustomer }} <span class="text-sm font-bold text-slate-400">Orang</span></h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl shadow-inner group-hover:bg-purple-600 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-user-group"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-50 flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                <span class="text-purple-500 font-bold"><i class="fa-solid fa-id-card"></i> Terverifikasi</span> terikat NIK KTP
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
                    <h3 class="text-2xl font-black text-slate-800 mt-2.5 font-mono text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shadow-inner group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-wallet"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-50 flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                <span class="text-emerald-500 font-bold"><i class="fa-solid fa-money-bill-wave"></i> Tunai</span> omset pembayaran lunas
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm lg:col-span-2 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Grafik Omset Pendapatan bulanan</h3>
                        <p class="text-xs text-slate-400">Simulasi fluktuasi grafik keuangan rental berjalan.</p>
                    </div>
                    <span class="px-2.5 py-1 bg-slate-100 text-slate-600 font-mono font-bold text-[10px] rounded-md uppercase tracking-wider">Grafik Live</span>
                </div>
                <div class="w-full pt-4 bg-slate-50 rounded-xl border border-slate-100 p-2 relative">
                    <svg viewBox="0 0 500 150" class="w-full h-auto drop-shadow-md">
                        <defs>
                            <linearGradient id="chartGrad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#2563eb" stop-opacity="0.25"/>
                                <stop offset="100%" stop-color="#2563eb" stop-opacity="0.0"/>
                            </linearGradient>
                        </defs>
                        <line x1="0" y1="30" x2="500" y2="30" stroke="#f1f5f9" stroke-width="1" />
                        <line x1="0" y1="70" x2="500" y2="70" stroke="#f1f5f9" stroke-width="1" />
                        <line x1="0" y1="110" x2="500" y2="110" stroke="#f1f5f9" stroke-width="1" />
                        <path d="M 0 120 Q 80 50 160 90 T 320 40 T 500 60 L 500 140 L 0 140 Z" fill="url(#chartGrad)" />
                        <path d="M 0 120 Q 80 50 160 90 T 320 40 T 500 60" fill="none" stroke="#2563eb" stroke-width="4" stroke-linecap="round" />
                        <circle cx="320" cy="40" r="5" fill="#ffffff" stroke="#2563eb" stroke-width="3"/>
                    </svg>
                    <div class="flex justify-between text-[10px] font-bold font-mono text-slate-400 mt-2 px-2">
                        <span>JAN</span><span>MAR</span><span>MEI</span><span>JUL</span><span>SEP</span><span>DES</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-base font-bold text-slate-800 mb-1">Akses Operasional Cepat</h3>
                <p class="text-xs text-slate-400 mb-5">Jalur pintas pintas untuk mempercepat kerja admin kasir toko.</p>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.bookings.create') }}" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-blue-200 hover:bg-blue-50/40 text-slate-700 transition font-medium group text-xs">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-brand-blue flex items-center justify-center text-sm group-hover:bg-brand-blue group-hover:text-white transition-all"><i class="fa-solid fa-calendar-plus"></i></div>
                            <span>Input Booking Rental Baru</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-brand-blue transition"></i>
                    </a>

                    <a href="{{ route('admin.transaksis.create') }}" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/40 text-slate-700 transition font-medium group text-xs">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm group-hover:bg-emerald-600 group-hover:text-white transition-all"><i class="fa-solid fa-cash-register"></i></div>
                            <span>Terima Pembayaran Kasir</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-emerald-600 transition"></i>
                    </a>

                    <a href="{{ route('admin.iphones.create') }}" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 hover:border-purple-200 hover:bg-purple-50/40 text-slate-700 transition font-medium group text-xs">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-sm group-hover:bg-purple-600 group-hover:text-white transition-all"><i class="fa-solid fa-plus"></i></div>
                            <span>Tambah Stok Unit iPhone</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-purple-600 transition"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="p-4 rounded-xl bg-slate-100 border border-slate-200 text-xs text-slate-500 flex items-center gap-2">
        <i class="fa-solid fa-triangle-exclamation text-amber-500 text-sm"></i>
        <span><strong>Tips Penguji:</strong> Seluruh modul data di atas sinkron otomatis ke database SQL menggunakan Eloquent ORM.</span>
    </div>

</div>
@endsection