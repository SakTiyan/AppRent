<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Saya - AppRent</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-square.png') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#0F172A',
                            blue: '#2563EB',
                            light: '#F8FAFC',
                            amber: '#F59E0B'
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        fredoka: ['Fredoka', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body
    class="bg-brand-light dark:bg-slate-950 text-brand-dark dark:text-slate-100 font-sans antialiased transition-colors duration-300 min-h-screen flex flex-col overflow-x-hidden">

    <nav
        class="sticky top-0 z-50 bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border-b border-slate-200/60 dark:border-slate-800/60 transition-colors duration-300">
        <div class="max-w-[1440px] mx-auto px-8 md:px-12 lg:px-24 h-20 flex items-center justify-between">

            <div class="w-1/4 flex items-center justify-start">
                <a href="/">
                    <img src="{{ asset('assets/img/logo-bg-dark.png') }}" alt="AppRent Logo"
                        class="h-8 lg:h-10 w-auto object-contain">
                </a>
            </div>

            <div
                class="w-2/4 hidden lg:flex items-center justify-center gap-8 text-[13px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">
                <a href="/"
                    class="{{ request()->is('/') ? 'text-brand-blue border-b-2 border-brand-blue pb-1' : 'hover:text-brand-blue transition' }}">Home</a>

                @if (Auth::check() && Auth::user()->role === 'customer')
                    <div class="relative inline-block text-left z-50">
                        <button type="button" id="mid-nav-dropdown-btn"
                            class="{{ request()->is('customer*') ? 'text-brand-blue border-b-2 border-brand-blue pb-1' : 'hover:text-brand-blue transition' }} flex items-center gap-1.5 focus:outline-none uppercase tracking-widest">
                            Customer <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-200"
                                id="mid-nav-arrow"></i>
                        </button>

                        <div id="mid-nav-dropdown-menu"
                            class="hidden absolute left-1/2 -translate-x-1/2 mt-3 w-48 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-800 shadow-xl py-2 focus:outline-none z-50">
                            <a href="{{ route('customer.dashboard') }}"
                                class="flex items-center gap-3 px-4 py-3 text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-brand-blue transition">
                                <i class="fa-solid fa-chart-pie text-slate-400 w-4 text-center"></i> Dashboard
                            </a>
                            <a href="{{ route('customer.history') }}"
                                class="flex items-center gap-3 px-4 py-3 text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-brand-blue transition">
                                <i class="fa-solid fa-clock-rotate-left text-slate-400 w-4 text-center"></i> Riwayat
                                Sewa
                            </a>
                            <a href="{{ route('customer.profile') }}"
                                class="flex items-center gap-3 px-4 py-3 text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50 hover:text-brand-blue transition">
                                <i class="fa-solid fa-user-gear text-slate-400 w-4 text-center"></i> Profile
                            </a>
                        </div>
                    </div>
                @endif

                <a href="/#sewa" class="hover:text-brand-blue transition">Sewa</a>
                <a href="/#prosedur" class="hover:text-brand-blue transition">Prosedur</a>
                <a href="/#testimoni" class="hover:text-brand-blue transition">Testimoni</a>
                <a href="/#faq" class="hover:text-brand-blue transition">FAQ</a>
            </div>

            <div class="w-1/4 flex items-center justify-end gap-3 md:gap-4">
                <button id="theme-toggle"
                    class="w-10 h-10 flex items-center justify-center rounded-[0.8rem] bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 focus:outline-none transition hover:bg-slate-200 dark:hover:bg-slate-700">
                    <i id="theme-toggle-light-icon" class="hidden fa-solid fa-sun text-brand-amber text-[1.1rem]"></i>
                    <i id="theme-toggle-dark-icon" class="hidden fa-solid fa-moon text-indigo-500 text-[1.1rem]"></i>
                </button>

                @if (Auth::check())
                    <a href="{{ route('customer.profile') }}" title="Edit Profil Anda"
                        class="shrink-0 transition transform hover:scale-105 mx-1">
                        @if (Auth::user()->foto_profil)
                            <img src="{{ asset('uploads/profiles/' . Auth::user()->foto_profil) }}"
                                class="w-10 h-10 rounded-full object-cover ring-2 ring-slate-200 dark:ring-slate-700 shadow-sm">
                        @else
                            <div
                                class="w-10 h-10 rounded-full bg-brand-blue text-white flex items-center justify-center font-bold text-sm ring-2 ring-slate-200 dark:ring-slate-700 shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-6 py-2.5 bg-[#E60000] hover:bg-red-700 text-white rounded-full text-xs font-black uppercase tracking-wider transition shadow-md flex items-center gap-2 whitespace-nowrap">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-2.5 bg-slate-900 dark:bg-white text-white dark:text-brand-dark rounded-xl text-xs md:text-sm font-bold shadow-lg transition transform hover:-translate-y-0.5 whitespace-nowrap">
                        Masuk
                    </a>
                @endif
            </div>

        </div>
    </nav>

    <main class="max-w-4xl w-full mx-auto p-6 flex-1 space-y-6 mt-4">
        <div
            class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold font-fredoka text-slate-800 dark:text-white">Selamat Datang,
                    {{ auth()->user()->name }}!</h1>
                <p class="text-xs text-slate-400 mt-1">Pantau status booking aktif dan tagihan denda sewa Anda di panel
                    ini.</p>
            </div>
            <div
                class="px-3 py-1 bg-emerald-500/10 text-emerald-500 rounded-full text-[10px] font-bold uppercase tracking-wider">
                Akun Terverifikasi</div>
        </div>

        @if ($isLate)
            <div
                class="bg-red-500/10 border border-red-500/30 text-red-600 dark:text-red-400 p-5 rounded-2xl flex gap-4 items-start animate-pulse">
                <div class="text-2xl"><i class="fa-solid fa-triangle-exertion"></i></div>
                <div>
                    <h3 class="font-bold text-sm">Peringatan Keterlambatan Pengembalian!</h3>
                    <p class="text-xs mt-1 text-red-500/90">Anda terdeteksi terlambat memulangkan unit iPhone selama
                        <span class="font-bold text-base font-mono">{{ $daysLate }}</span> Hari. Akumulasi denda
                        berjalan saat ini: <span class="font-black text-base font-mono">Rp
                            {{ number_format($estimatedDenda, 0, ',', '.') }}</span>.</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-2 gap-4">
            <div
                class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-100 dark:border-slate-800 text-center">
                <div class="text-3xl font-black text-brand-blue font-fredoka">{{ $activeRentalsCount }}</div>
                <p class="text-[10px] uppercase font-bold tracking-wider text-slate-400 mt-1">Sewa Berjalan (Aktif)</p>
            </div>
            <div
                class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-100 dark:border-slate-800 text-center">
                <div class="text-3xl font-black text-slate-600 dark:text-slate-400 font-fredoka">
                    {{ $totalBookingsCount }}</div>
                <p class="text-[10px] uppercase font-bold tracking-wider text-slate-400 mt-1">Total Transaksi Historis
                </p>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 overflow-hidden">
            <div class="p-4 font-bold text-sm border-b border-slate-100 dark:border-slate-800 font-fredoka">5 Aktivitas
                Sewa Terbaru</div>
            <div class="divide-y divide-slate-100 dark:divide-slate-800/50">
                @forelse($bookings as $b)
                    <div class="p-4 flex items-center justify-between text-xs">
                        <div>
                            <p class="font-bold text-slate-800 dark:text-white">{{ $b->iphone->tipe_iphone }}</p>
                            <p class="text-slate-400 mt-0.5">{{ date('d M Y', strtotime($b->tgl_sewa)) }} ➔
                                {{ date('d M Y', strtotime($b->tgl_kembali)) }} ({{ $b->total_hari }} Hari)</p>
                        </div>
                        <div>
                            @if ($b->status_booking === 'Aktif')
                                <span
                                    class="px-2 py-1 bg-blue-500/10 text-blue-500 rounded font-bold uppercase text-[9px]">Aktif</span>
                            @elseif($b->status_booking === 'Selesai')
                                <span
                                    class="px-2 py-1 bg-emerald-500/10 text-emerald-500 rounded font-bold uppercase text-[9px]">Selesai</span>
                            @else
                                <span
                                    class="px-2 py-1 bg-red-500/10 text-red-500 rounded font-bold uppercase text-[9px]">Batal</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-center py-6 text-slate-400 text-xs">Belum ada transaksi pemesanan diajukan.</p>
                @endforelse
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SCRIPT DROPDOWN TENGAH
            const midNavBtn = document.getElementById('mid-nav-dropdown-btn');
            const midNavMenu = document.getElementById('mid-nav-dropdown-menu');
            const midNavArrow = document.getElementById('mid-nav-arrow');

            if (midNavBtn && midNavMenu) {
                midNavBtn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    if (midNavMenu.classList.contains('hidden')) {
                        midNavMenu.classList.remove('hidden');
                        midNavArrow.classList.add('rotate-180');
                    } else {
                        midNavMenu.classList.add('hidden');
                        midNavArrow.classList.remove('rotate-180');
                    }
                });

                document.addEventListener('click', function(event) {
                    if (!midNavBtn.contains(event.target) && !midNavMenu.contains(event.target)) {
                        midNavMenu.classList.add('hidden');
                        midNavArrow.classList.remove('rotate-180');
                    }
                });
            }

            // DARK MODE LOGIC
            var themeToggleBtn = document.getElementById('theme-toggle');
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window
                    .matchMedia('(prefers-color-scheme: dark)').matches)) {
                if (themeToggleLightIcon) themeToggleLightIcon.classList.remove('hidden');
            } else {
                if (themeToggleDarkIcon) themeToggleDarkIcon.classList.remove('hidden');
            }

            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', function() {
                    themeToggleDarkIcon.classList.toggle('hidden');
                    themeToggleLightIcon.classList.toggle('hidden');
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                });
            }
        });
    </script>
</body>

</html>
