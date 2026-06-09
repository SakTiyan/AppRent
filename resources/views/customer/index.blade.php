<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AppRent - Rental iPhone Premium #1</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-square.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

    <style>
        .star-rating {
            color: #F59E0B;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #334155;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-marquee {
            display: flex;
            animation: marquee 30s linear infinite;
        }

        .faq-item.active {
            border-color: #2563EB;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.1);
        }

        /* Animasi Dropdown Tengah */
        .nav-dropdown-active {
            opacity: 1 !important;
            transform: scale(100%) translateY(0) !important;
            pointer-events: auto !important;
        }
    </style>

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body
    class="bg-brand-light dark:bg-slate-950 text-brand-dark dark:text-slate-100 font-sans antialiased transition-colors duration-300 overflow-x-hidden">

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
                <a href="#home"
                    class="nav-item-link text-brand-blue border-b-2 border-brand-blue pb-1 transition">Home</a>

                @if (Auth::check() && Auth::user()->role === 'customer')
                    <div class="relative inline-block text-left">
                        <button type="button" id="mid-nav-dropdown-btn"
                            class="hover:text-brand-blue dark:hover:text-white transition flex items-center gap-1.5 focus:outline-none uppercase tracking-widest text-slate-500 dark:text-slate-400">
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

                <a href="#sewa" class="nav-item-link hover:text-brand-blue transition">Sewa</a>
                <a href="#prosedur" class="nav-item-link hover:text-brand-blue transition">Prosedur</a>
                <a href="#testimoni" class="nav-item-link hover:text-brand-blue transition">Testimoni</a>
                <a href="#faq" class="nav-item-link hover:text-brand-blue transition">FAQ</a>
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
                            class="px-6 py-2.5 bg-[#E60000] hover:bg-red-700 text-white rounded-full text-xs font-black uppercase tracking-wider transition transform hover:-translate-y-0.5 shadow-md flex items-center gap-2 whitespace-nowrap">
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

    <header id="home"
        class="max-w-[1440px] mx-auto px-8 md:px-12 lg:px-24 py-16 lg:py-28 flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-8">
        <div class="w-full lg:w-1/2 space-y-8" data-aos="fade-right">
            <div
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-500/10 border border-blue-500/20 rounded-full">
                <span class="relative flex h-2.5 w-2.5"><span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span><span
                        class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500"></span></span>
                <span class="text-[11px] font-black uppercase tracking-[0.2em] text-brand-blue">Rental iPhone
                    Terpercaya</span>
            </div>

            <h1
                class="text-5xl md:text-6xl lg:text-[5.5rem] font-black leading-[1.05] font-fredoka text-slate-900 dark:text-white">
                Bikin Momen <br> Jadi <span class="text-brand-blue">Lebih</span> <br><span
                    class="text-cyan-500">Sinematik.</span>
            </h1>

            <p class="text-slate-500 dark:text-slate-400 text-lg max-w-md leading-relaxed pt-2">Pinjam unit iPhone
                generasi terbaru dengan kondisi 100% mulus untuk kebutuhan wedding, traveling, atau konten harianmu.</p>

            <div class="flex items-center gap-4">
                <a href="#sewa"
                    class="px-8 py-4 bg-brand-blue hover:bg-blue-700 text-white font-bold rounded-2xl shadow-xl shadow-blue-500/40 transition transform hover:-translate-y-1">Mulai
                    Sewa</a>
            </div>
        </div>

        <div class="w-full lg:w-1/2 relative flex justify-center lg:justify-end" data-aos="zoom-in">
            <div class="absolute inset-0 bg-brand-blue/20 blur-[90px] rounded-full z-0 w-2/3 lg:mr-0"></div>
            <img src="{{ asset('assets/img/hp.png') }}"
                class="relative z-10 w-full max-w-[280px] sm:max-w-[320px] lg:max-w-[350px] xl:max-w-[380px] h-auto object-contain drop-shadow-2xl"
                alt="iPhone 15 Pro">
        </div>
    </header>

    <div class="py-6 bg-slate-900 dark:bg-brand-blue overflow-hidden flex whitespace-nowrap border-y border-white/10">
        <div class="flex animate-marquee items-center gap-12 text-white font-black uppercase tracking-[0.3em] text-sm">
            <span>• Premium Rental • iPhone 15 Pro Max • AppRent Official • Original Apple • iPhone 14 Pro • Premium
                Quality • Best Price</span>
            <span>• Premium Rental • iPhone 15 Pro Max • AppRent Official • Original Apple • iPhone 14 Pro • Premium
                Quality • Best Price</span>
        </div>
    </div>

    <section id="sewa"
        class="max-w-[1440px] mx-auto px-8 md:px-12 lg:px-24 py-24 space-y-16 bg-slate-50 dark:bg-slate-900/30">
        <div class="text-center space-y-4">
            <h2 class="text-4xl font-black font-fredoka" data-aos="fade-up">Katalog Sewa iPhone</h2>
            <p class="text-slate-500 dark:text-slate-400 max-w-lg mx-auto" data-aos="fade-up" data-aos-delay="100">
                Pilih unit sesuai kebutuhanmu. Langsung amankan stok lewat web atau tanya Admin via WA.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 lg:gap-10">
            @forelse($iphones as $iphone)
                <div class="group bg-white dark:bg-slate-900 rounded-[2rem] p-6 flex flex-col border border-slate-100 dark:border-slate-800 hover:shadow-2xl transition-all duration-300"
                    data-aos="fade-up">
                    <div
                        class="relative w-full aspect-[4/5] bg-white dark:bg-slate-900 rounded-t-[1.5rem] rounded-b-[2.5rem] mb-6 flex items-center justify-center">
                        <div
                            class="absolute top-2 right-2 z-10 px-4 py-1.5 bg-[#D1F4E0] dark:bg-emerald-900/40 rounded-full">
                            <span
                                class="text-[10px] font-black text-[#10B981] dark:text-emerald-400 uppercase tracking-widest">Tersedia</span>
                        </div>
                        @if ($iphone->gambar)
                            <img src="{{ asset('uploads/iphones/' . $iphone->gambar) }}"
                                class="h-[85%] object-contain group-hover:scale-105 transition-transform duration-500 ease-out z-0">
                        @else
                            <i class="fa-solid fa-mobile-screen text-7xl text-slate-200 dark:text-slate-700"></i>
                        @endif
                        <div
                            class="absolute bottom-0 left-4 right-4 h-6 bg-slate-100/50 dark:bg-slate-800/30 rounded-b-[2rem] blur-md -z-10">
                        </div>
                    </div>

                    <div class="px-2 flex-1 flex flex-col">
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-1 leading-tight">
                            {{ $iphone->tipe_iphone }}</h3>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $iphone->kapasitas }}
                            GB • {{ $iphone->warna }}</p>

                        <div class="w-full h-px bg-slate-100 dark:bg-slate-800 my-5"></div>

                        <div class="mb-8">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Tarif Sewa
                            </p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-4xl font-black text-brand-blue dark:text-blue-500">Rp
                                    {{ number_format($iphone->harga_perhari, 0, ',', '.') }}</span>
                                <span class="text-sm font-medium text-slate-400">/hari</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 mt-auto">
                            <a href="https://wa.me/6282110186527?text=Halo%20Admin,%20saya%20mau%20tanya%20sewa%20{{ urlencode($iphone->tipe_iphone) }}%20({{ $iphone->kapasitas }}GB)."
                                target="_blank"
                                class="w-full py-4 bg-[#E6F8EF] dark:bg-emerald-900/20 text-[#10B981] hover:bg-[#10B981] hover:text-white rounded-xl text-center transition-colors flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                                <span class="text-[11px] font-black uppercase tracking-wider">Tanya WA</span>
                            </a>

                            <a href="{{ route('customer.booking.create', $iphone->id) }}"
                                class="w-full py-4 bg-[#0B1120] text-white hover:bg-brand-blue rounded-xl text-center transition-colors flex items-center justify-center gap-2">
                                <span class="text-[11px] font-black uppercase tracking-wider">Booking</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-1 md:col-span-2 xl:col-span-3 text-center py-20 bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-200 dark:border-slate-800">
                    <p class="text-slate-400 font-bold uppercase tracking-[0.2em]">Semua unit sedang disewa. Cek
                        kembali nanti.</p>
                </div>
            @endforelse
        </div>
    </section>

    <section id="prosedur" class="bg-slate-900 dark:bg-slate-900/50 py-24 text-white">
        <div class="max-w-[1440px] mx-auto px-8 md:px-16 lg:px-24 space-y-16">
            <div class="text-center space-y-4">
                <h2 class="text-4xl font-black font-fredoka">Prosedur Sewa</h2>
                <p class="text-slate-400 max-w-md mx-auto">Kami mengedepankan kepercayaan dan kecepatan layanan.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="space-y-4 p-8 bg-white/5 rounded-3xl border border-white/10 hover:bg-white/10 transition"
                    data-aos="fade-up">
                    <div class="text-5xl font-black text-brand-blue opacity-50 font-fredoka">01</div>
                    <h3 class="text-xl font-bold">Booking Web</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">Pilih unit di web, login, dan isi tanggal
                        pengajuan sewa.</p>
                </div>
                <div class="space-y-4 p-8 bg-white/5 rounded-3xl border border-white/10 hover:bg-white/10 transition"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="text-5xl font-black text-brand-amber opacity-50 font-fredoka">02</div>
                    <h3 class="text-xl font-bold">Bawa Identitas</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">Datang ke toko kami dengan membawa KTP Asli
                        penyewa.</p>
                </div>
                <div class="space-y-4 p-8 bg-white/5 rounded-3xl border border-white/10 hover:bg-white/10 transition"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="text-5xl font-black text-emerald-500 opacity-50 font-fredoka">03</div>
                    <h3 class="text-xl font-bold">Bayar Tunai</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">Pembayaran dilakukan di meja kasir setelah unit
                        divalidasi.</p>
                </div>
                <div class="space-y-4 p-8 bg-white/5 rounded-3xl border border-white/10 hover:bg-white/10 transition"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="text-5xl font-black text-purple-500 opacity-50 font-fredoka">04</div>
                    <h3 class="text-xl font-bold">Bawa Pulang</h3>
                    <p class="text-sm text-slate-400 leading-relaxed">Unit iPhone siap digunakan untuk seluruh
                        aktivitas premiummu.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="testimoni" class="max-w-[1440px] mx-auto px-8 md:px-16 lg:px-24 py-24 space-y-16">
        <div class="text-center space-y-4">
            <h2 class="text-4xl font-black font-fredoka">Testimoni Pelanggan</h2>
            <p class="text-slate-500 dark:text-slate-400">Ribuan pelanggan telah membuktikan kualitas unit kami.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white dark:bg-slate-900 p-8 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm"
                data-aos="fade-up">
                <div class="star-rating mb-4 flex gap-1 text-xs"><i class="fa-solid fa-star"></i><i
                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                <p class="text-slate-600 dark:text-slate-300 italic text-sm leading-relaxed">"iPhone 15 Pro-nya beneran
                    mulus banget, batre awet buat shooting seharian di event nikahan. Trusted!"</p>
                <div class="mt-6 flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center font-bold text-brand-blue">
                        A</div>
                    <div class="text-xs">
                        <p class="font-black text-slate-800 dark:text-white">Andri Wijaya</p>
                        <p class="text-slate-400">Content Creator</p>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-8 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm"
                data-aos="fade-up" data-aos-delay="100">
                <div class="star-rating mb-4 flex gap-1 text-xs"><i class="fa-solid fa-star"></i><i
                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                <p class="text-slate-600 dark:text-slate-300 italic text-sm leading-relaxed">"Proses sewa cuma 5 menit
                    langsung dapet unit. Cocok banget buat tugas kuliah videografi akhir pekan."</p>
                <div class="mt-6 flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center font-bold text-brand-amber">
                        S</div>
                    <div class="text-xs">
                        <p class="font-black text-slate-800 dark:text-white">Siti Nurhaliza</p>
                        <p class="text-slate-400">Mahasiswa</p>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-8 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm"
                data-aos="fade-up" data-aos-delay="200">
                <div class="star-rating mb-4 flex gap-1 text-xs"><i class="fa-solid fa-star"></i><i
                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                        class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                <p class="text-slate-600 dark:text-slate-300 italic text-sm leading-relaxed">"Layanan antar jemput
                    on-time, admin fast respon kalau ditanya-tanya lewat WhatsApp. Bintang 5!"</p>
                <div class="mt-6 flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center font-bold text-emerald-600">
                        B</div>
                    <div class="text-xs">
                        <p class="font-black text-slate-800 dark:text-white">Budi Santoso</p>
                        <p class="text-slate-400">Wiraswasta</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="max-w-[1000px] mx-auto px-8 md:px-16 lg:px-24 py-24 space-y-12">
        <div class="text-center space-y-4">
            <h2 class="text-4xl font-black font-fredoka">Tanya Jawab (FAQ)</h2>
            <p class="text-slate-500 dark:text-slate-400">Hal-hal yang paling sering ditanyakan oleh calon penyewa.</p>
        </div>
        <div class="space-y-4">
            <div
                class="faq-item group bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/60 dark:border-slate-800 overflow-hidden transition-all duration-300">
                <button class="w-full p-6 text-left flex items-center justify-between focus:outline-none"><span
                        class="font-bold text-slate-800 dark:text-white">Apa saja persyaratan sewa iPhone?</span><i
                        class="fa-solid fa-chevron-down transition duration-300 group-[.active]:rotate-180 text-brand-blue"></i></button>
                <div class="max-h-0 group-[.active]:max-h-40 transition-all duration-500 ease-in-out">
                    <p
                        class="p-6 pt-0 text-sm text-slate-500 dark:text-slate-400 leading-relaxed border-t border-slate-50 dark:border-slate-800">
                        Cukup lampirkan KTP Asli (Domisili sesuai daerah operasional) sebagai jaminan utama penahanan
                        saat pengambilan unit.</p>
                </div>
            </div>
            <div
                class="faq-item group bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/60 dark:border-slate-800 overflow-hidden transition-all duration-300">
                <button class="w-full p-6 text-left flex items-center justify-between focus:outline-none"><span
                        class="font-bold text-slate-800 dark:text-white">Apakah ada denda keterlambatan?</span><i
                        class="fa-solid fa-chevron-down transition duration-300 group-[.active]:rotate-180 text-brand-blue"></i></button>
                <div class="max-h-0 group-[.active]:max-h-40 transition-all duration-500 ease-in-out">
                    <p
                        class="p-6 pt-0 text-sm text-slate-500 dark:text-slate-400 leading-relaxed border-t border-slate-50 dark:border-slate-800">
                        Keterlambatan pengembalian unit melebihi tanggal di nota akan dikenakan denda keterlambatan
                        proporsional per harinya.</p>
                </div>
            </div>
            <div
                class="faq-item group bg-white dark:bg-slate-900 rounded-3xl border border-slate-200/60 dark:border-slate-800 overflow-hidden transition-all duration-300">
                <button class="w-full p-6 text-left flex items-center justify-between focus:outline-none"><span
                        class="font-bold text-slate-800 dark:text-white">Bolehkah login iCloud pribadi?</span><i
                        class="fa-solid fa-chevron-down transition duration-300 group-[.active]:rotate-180 text-brand-blue"></i></button>
                <div class="max-h-0 group-[.active]:max-h-40 transition-all duration-500 ease-in-out">
                    <p
                        class="p-6 pt-0 text-sm text-slate-500 dark:text-slate-400 leading-relaxed border-t border-slate-50 dark:border-slate-800">
                        Sangat boleh. Anda diizinkan masuk menggunakan Apple ID pribadi untuk mengunduh aplikasi, namun
                        wajib di-logout bersih saat pengembalian.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-slate-50 dark:bg-slate-900/30 border-t border-slate-200 dark:border-slate-800 pt-16 pb-8">
        <div class="max-w-[1440px] mx-auto px-8 md:px-16 lg:px-24 grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="col-span-2 space-y-6">
                <img src="{{ asset('assets/img/logo-bg-dark.png') }}" alt="AppRent Logo"
                    class="h-10 w-auto object-contain">
                <p class="text-slate-500 dark:text-slate-400 text-sm max-w-xs leading-relaxed">Solusi terbaik untuk
                    pengalaman menggunakan gadget premium tanpa beban kepemilikan. Sewa mudah, gaya mewah.</p>
                <div class="flex gap-4 text-slate-400">
                    <a href="#" class="hover:text-brand-blue transition"><i
                            class="fa-brands fa-instagram text-xl"></i></a>
                    <a href="#" class="hover:text-brand-blue transition"><i
                            class="fa-brands fa-tiktok text-xl"></i></a>
                </div>
            </div>
            <div class="space-y-6 text-sm">
                <h4 class="font-black uppercase tracking-widest text-slate-400">Pintasan Web</h4>
                <div class="flex flex-col gap-4 font-bold text-slate-600 dark:text-slate-300">
                    <a href="#sewa" class="hover:text-brand-blue">Katalog Sewa</a>
                    <a href="#prosedur" class="hover:text-brand-blue">Prosedur Peminjaman</a>
                    <a href="#faq" class="hover:text-brand-blue">Pusat Bantuan</a>
                </div>
            </div>
        </div>
        <div
            class="text-center text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 border-t border-slate-200 dark:border-slate-800 pt-8">
            &copy; 2026 AppRent Corporation • All Rights Reserved
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // SCRIPT DROPDOWN MENU TENGAH (NAVIGASI)
            const midNavBtn = document.getElementById('mid-nav-dropdown-btn');
            const midNavMenu = document.getElementById('mid-nav-dropdown-menu');
            const midNavArrow = document.getElementById('mid-nav-arrow');

            if (midNavBtn && midNavMenu) {
                midNavBtn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    const isActive = midNavMenu.classList.contains('nav-dropdown-active');

                    if (!isActive) {
                        midNavMenu.classList.remove('hidden');
                        setTimeout(() => {
                            midNavMenu.classList.add('nav-dropdown-active');
                        }, 10);
                        midNavArrow.classList.add('rotate-180');
                    } else {
                        closeMidDropdown();
                    }
                });

                document.addEventListener('click', function(event) {
                    if (!midNavBtn.contains(event.target) && !midNavMenu.contains(event.target)) {
                        closeMidDropdown();
                    }
                });

                function closeMidDropdown() {
                    midNavMenu.classList.remove('nav-dropdown-active');
                    midNavArrow.classList.remove('rotate-180');
                }
            }

            // SCRIPT SCROLLSPY (GARIS BAWAH AKTIF SAAT SCROLL/KLIK)
            const sections = document.querySelectorAll(
                'header#home, section#sewa, section#prosedur, section#testimoni, section#faq');
            const navLinks = document.querySelectorAll('.nav-item-link');

            window.addEventListener('scroll', () => {
                let current = '';
                const scrollY = window.pageYOffset;

                sections.forEach(section => {
                    const sectionHeight = section.offsetHeight;
                    const sectionTop = section.offsetTop - 150; // offset navbar
                    if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                        current = section.getAttribute('id');
                    }
                });

                // Fallback ke home jika sedang di paling atas
                if (scrollY < 100) current = 'home';

                navLinks.forEach(link => {
                    // Reset class untuk semua menu
                    link.classList.remove('text-brand-blue', 'border-b-2', 'border-brand-blue',
                        'pb-1');
                    link.classList.add('hover:text-brand-blue', 'transition');

                    // Tambahkan class aktif untuk menu yang bersesuaian dengan id
                    if (link.getAttribute('href') === '#' + current) {
                        link.classList.remove('hover:text-brand-blue');
                        link.classList.add('text-brand-blue', 'border-b-2', 'border-brand-blue',
                            'pb-1');
                    }
                });
            });

            // LOGIKA DARK MODE
            var themeToggleBtn = document.getElementById('theme-toggle');
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window
                    .matchMedia('(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }

            themeToggleBtn.addEventListener('click', function() {
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
            });

            // LOGIKA FAQ
            document.querySelectorAll('.faq-item button').forEach(button => {
                button.addEventListener('click', () => {
                    const item = button.parentElement;
                    document.querySelectorAll('.faq-item').forEach(otherItem => {
                        if (otherItem !== item) otherItem.classList.remove('active');
                    });
                    item.classList.toggle('active');
                });
            });
        });
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>

</html>
