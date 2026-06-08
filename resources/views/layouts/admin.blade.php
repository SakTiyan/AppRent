<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AppRent Panel - @yield('title')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-square.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#0F172A',
                            blue: '#2563EB',
                            light: '#F8FAFC',
                            amber: '#F59E0B',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body class="bg-brand-light text-brand-dark font-sans antialiased">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-brand-dark text-white flex flex-col z-20 shadow-xl transition-all duration-300">
            <div class="p-5 flex items-center gap-3 border-b border-slate-800">
                <img src="{{ asset('assets/img/logo-square.png') }}" alt="Logo" class="w-8 h-8 rounded-lg">
                <div>
                    <h1 class="text-lg font-bold tracking-tight text-white">AppRent</h1>
                    <p class="text-xs text-brand-amber font-medium">Panel {{ ucfirst(Auth::user()->role) }}</p>
                </div>
            </div>

            <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-brand-blue text-white font-medium shadow-md shadow-brand-blue/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i> Dashboard
                </a>

                @if (Auth::user()->role == 'admin')
                    <div class="pt-4 pb-1 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Master Data</div>
                    
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.users*') ? 'bg-brand-blue text-white font-medium shadow-md shadow-brand-blue/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-users-gear w-5 text-center"></i> Kelola Kasir
                    </a>
                    
                    <a href="{{ route('admin.iphones.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.iphones*') ? 'bg-brand-blue text-white font-medium shadow-md shadow-brand-blue/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <i class="fa-solid fa-mobile-screen w-5 text-center"></i> Data iPhone
                    </a>
                @endif

                <div class="pt-4 pb-1 px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Operasional</div>

                <a href="{{ route('admin.customers.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.customers*') ? 'bg-brand-blue text-white font-medium shadow-md shadow-brand-blue/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-user-group w-5 text-center"></i> Data Customer
                </a>

                <a href="{{ route('admin.bookings.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.bookings*') ? 'bg-brand-blue text-white font-medium shadow-md shadow-brand-blue/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-calendar-check w-5 text-center"></i> Data Booking
                </a>

                <a href="{{ route('admin.transaksis.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.transaksis*') ? 'bg-brand-blue text-white font-medium shadow-md shadow-brand-blue/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-receipt w-5 text-center"></i> Transaksi Bayar
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800 bg-slate-950/50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-red-500/10 hover:bg-red-50 text-red-500 hover:text-white py-2.5 rounded-xl transition font-medium text-sm">
                        <i class="fa-solid fa-right-from-bracket"></i> Keluar Sistem
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">

            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-6 z-10">
                <div class="flex items-center gap-3">
                    <h2 class="text-sm font-medium text-gray-500">Selamat bekerja, <span class="text-brand-dark font-semibold">{{ Auth::user()->name }}</span>!</h2>
                </div>

                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400 capitalize">{{ Auth::user()->role }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-brand-blue/10 text-brand-blue flex items-center justify-center font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-brand-light p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 600,
            once: true
        });
    </script>
    @stack('scripts')

    @include('components.toast')
</body>

</html>