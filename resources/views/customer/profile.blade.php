<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Saya - AppRent</title>
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
    class="bg-brand-light dark:bg-slate-950 text-brand-dark dark:text-slate-100 antialiased font-sans min-h-screen flex flex-col transition-colors duration-300 overflow-x-hidden">

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

    <div class="max-w-2xl w-full mx-auto py-12 px-6 flex-1">
        <div
            class="bg-white dark:bg-slate-900 p-8 md:p-10 rounded-[2rem] border border-slate-200 dark:border-slate-800 shadow-sm">
            <h1 class="text-3xl font-black font-fredoka mb-2 text-slate-800 dark:text-white">Profil Saya</h1>
            <p class="text-slate-500 text-sm mb-8">Atur data diri, email, password, dan foto profil Anda di sini.</p>

            @if (session('success'))
                <div
                    class="bg-emerald-50 dark:bg-emerald-950/20 text-emerald-600 dark:text-emerald-400 p-4 rounded-xl text-sm font-bold mb-6 border border-emerald-200 dark:border-emerald-800">
                    {{ session('success') }}</div>
            @endif

            <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                <div
                    class="flex flex-col md:flex-row items-center gap-6 pb-6 border-b border-slate-100 dark:border-slate-800">
                    <div class="shrink-0">
                        @if (Auth::user()->foto_profil)
                            <img src="{{ asset('uploads/profiles/' . Auth::user()->foto_profil) }}"
                                class="w-24 h-24 rounded-full object-cover border-4 border-slate-100 dark:border-slate-800">
                        @else
                            <div
                                class="w-24 h-24 rounded-full bg-brand-blue text-white flex items-center justify-center font-bold text-3xl border-4 border-slate-100 dark:border-slate-800">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        @endif
                    </div>
                    <div class="w-full">
                        <label
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-2">Ganti
                            Foto Profil</label>
                        <input type="file" name="foto_profil" accept="image/*"
                            class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-blue-50 dark:file:bg-slate-800 file:text-brand-blue cursor-pointer">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-2">Nama
                            Lengkap</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-sm outline-none focus:ring-2 focus:ring-brand-blue dark:text-white"
                            required>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-2">Alamat
                            Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-sm outline-none focus:ring-2 focus:ring-brand-blue dark:text-white"
                            required>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 dark:border-slate-800 space-y-6">
                    <div>
                        <label
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-2">Ganti
                            Password (Opsional)</label>
                        <input type="password" name="password" placeholder="Kosongkan jika tidak ingin diubah"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-sm outline-none focus:ring-2 focus:ring-brand-blue dark:text-white">
                    </div>
                    <div>
                        <label
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wide mb-2">Konfirmasi
                            Password Baru</label>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-sm outline-none focus:ring-2 focus:ring-brand-blue dark:text-white">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-4 bg-brand-blue hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg transition duration-200 transform hover:-translate-y-0.5">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
            var themeToggleBtn = document.getElementById('theme-toggle');
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window
                    .matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.getElementById('theme-toggle-light-icon').classList.remove('hidden');
            } else {
                document.getElementById('theme-toggle-dark-icon').classList.remove('hidden');
            }
            themeToggleBtn.addEventListener('click', function() {
                document.getElementById('theme-toggle-dark-icon').classList.toggle('hidden');
                document.getElementById('theme-toggle-light-icon').classList.toggle('hidden');
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            });
        });
    </script>
</body>

</html>
