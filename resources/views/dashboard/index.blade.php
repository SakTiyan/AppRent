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
                    @if (auth()->user()->role === 'admin')
                        Selamat Datang, <span class="text-brand-blue">Administrator</span>!
                    @elseif(auth()->user()->role === 'kasir')
                        Selamat Datang, <span class="text-brand-blue">Staf</span>!
                    @else
                        Selamat Datang!
                    @endif
                </h1>
                
                <p class="text-slate-400 text-sm mt-1">Pantau performa bisnis rental dan sirkulasi kasir AppRent hari ini.</p>
            </div>
            <div class="bg-white/5 backdrop-blur-md px-4 py-2.5 rounded-xl border border-white/10 text-right relative z-10">
                <p class="text-xs text-slate-400 font-medium">Tanggal Hari Ini</p>
                <p class="text-sm font-bold text-white font-mono mt-0.5">{{ date('d F Y') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total iPhone</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white mt-2 font-mono">{{ $totalIphone }} <span class="text-sm font-bold text-slate-400 dark:text-slate-500">Unit</span></h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-brand-blue/10 text-brand-blue flex items-center justify-center text-xl shadow-inner group-hover:bg-brand-blue group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 dark:border-slate-800/50 flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                    <span class="text-emerald-500 font-bold"><i class="fa-solid fa-arrow-trend-up"></i> Real-time</span> data inventaris aktif
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Booking Aktif</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white mt-2 font-mono">{{ $totalBooking }} <span class="text-sm font-bold text-slate-400 dark:text-slate-500">Trx</span></h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-brand-amber/10 text-brand-amber flex items-center justify-center text-xl shadow-inner group-hover:bg-brand-amber group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 dark:border-slate-800/50 flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                    <span class="text-amber-500 font-bold"><i class="fa-solid fa-clock"></i> Sedang Jalan</span> masa sewa berjalan
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Customer</p>
                        <h3 class="text-3xl font-black text-slate-800 dark:text-white mt-2 font-mono">{{ $totalCustomer }} <span class="text-sm font-bold text-slate-400 dark:text-slate-500">Orang</span></h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center text-xl shadow-inner group-hover:bg-purple-600 group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 dark:border-slate-800/50 flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                    <span class="text-purple-500 font-bold"><i class="fa-solid fa-id-card"></i> Terverifikasi</span> terikat NIK KTP
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white mt-2.5 font-mono text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500 dark:from-emerald-400 dark:to-teal-300">
                            Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                        </h3>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl shadow-inner group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 dark:border-slate-800/50 flex items-center gap-1.5 text-xs text-slate-400 font-medium">
                    <span class="text-emerald-500 font-bold"><i class="fa-solid fa-money-bill-wave"></i> Tunai</span> omset pembayaran lunas
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm lg:col-span-2 flex flex-col justify-between transition-colors duration-300">
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-base font-bold text-slate-800 dark:text-white">Grafik Omset Pendapatan Bulanan</h3>
                            <p class="text-xs text-slate-400">Simulasi fluktuasi grafik keuangan rental tahun {{ date('Y') }}.</p>
                        </div>
                        <span class="px-2.5 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 font-mono font-bold text-[10px] rounded-md uppercase tracking-wider animate-pulse">Grafik Live</span>
                    </div>
                    
                    <div class="w-full pt-4 bg-slate-50 dark:bg-slate-950/50 rounded-xl border border-slate-100 dark:border-slate-800/80 p-4 relative transition-colors duration-300 h-[250px]">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm flex flex-col justify-between transition-colors duration-300">
                <div>
                    <h3 class="text-base font-bold text-slate-800 dark:text-white mb-1">Akses Operasional Cepat</h3>
                    <p class="text-xs text-slate-400 mb-5">Jalur pintas untuk mempercepat kerja admin/kasir.</p>

                    <div class="space-y-3">
                        <a href="{{ route('admin.bookings.create') }}" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 dark:border-slate-800 hover:border-blue-200 dark:hover:border-blue-900/50 hover:bg-blue-50/40 dark:hover:bg-brand-blue/10 text-slate-700 dark:text-slate-300 transition font-medium group text-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-brand-blue/20 text-brand-blue flex items-center justify-center text-sm group-hover:bg-brand-blue group-hover:text-white transition-all">
                                    <i class="fa-solid fa-calendar-plus"></i>
                                </div>
                                <span>Input Booking Rental Baru</span>
                            </div>
                            <i class="fa-solid fa-chevron-right text-slate-300 dark:text-slate-600 group-hover:text-brand-blue transition"></i>
                        </a>

                        <a href="{{ route('admin.transaksis.create') }}" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 dark:border-slate-800 hover:border-emerald-200 dark:hover:border-emerald-900/50 hover:bg-emerald-50/40 dark:hover:bg-emerald-500/10 text-slate-700 dark:text-slate-300 transition font-medium group text-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-sm group-hover:bg-emerald-600 group-hover:text-white transition-all">
                                    <i class="fa-solid fa-cash-register"></i>
                                </div>
                                <span>Terima Pembayaran Kasir</span>
                            </div>
                            <i class="fa-solid fa-chevron-right text-slate-300 dark:text-slate-600 group-hover:text-emerald-600 transition"></i>
                        </a>

                        <a href="{{ route('admin.iphones.create') }}" class="flex items-center justify-between p-3 rounded-xl border border-slate-100 dark:border-slate-800 hover:border-purple-200 dark:hover:border-purple-900/50 hover:bg-purple-50/40 dark:hover:bg-purple-500/10 text-slate-700 dark:text-slate-300 transition font-medium group text-xs">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-purple-50 dark:bg-purple-500/20 text-purple-600 dark:text-purple-400 flex items-center justify-center text-sm group-hover:bg-purple-600 group-hover:text-white transition-all">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <span>Tambah Stok Unit iPhone</span>
                            </div>
                            <i class="fa-solid fa-chevron-right text-slate-300 dark:text-slate-600 group-hover:text-purple-600 transition"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            
            // Efek gradasi warna biru di bawah garis grafik
            let gradientFill = ctx.createLinearGradient(0, 0, 0, 250);
            gradientFill.addColorStop(0, 'rgba(37, 99, 235, 0.4)'); 
            gradientFill.addColorStop(1, 'rgba(37, 99, 235, 0.0)'); 

            // Mengambil data pendapatan yang dilempar dari Controller
            const dataPendapatan = @json($grafikPendapatan);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['JAN', 'FEB', 'MAR', 'APR', 'MEI', 'JUN', 'JUL', 'AGU', 'SEP', 'OKT', 'NOV', 'DES'],
                    datasets: [{
                        label: 'Total Omset',
                        data: dataPendapatan,
                        borderColor: '#2563eb', // Warna garis utama
                        backgroundColor: gradientFill,
                        borderWidth: 3,
                        tension: 0.4, // Membuat garis melengkung
                        fill: true,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#2563eb',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: 'rgba(15, 23, 42, 0.9)', 
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            padding: 10,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                // Memformat angka yang muncul di tooltip menjadi format Rupiah
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { font: { size: 10, family: 'monospace' }, color: '#94a3b8' }
                        },
                        y: {
                            display: false, 
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection