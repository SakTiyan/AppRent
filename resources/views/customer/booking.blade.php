<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Booking Sewa - AppRent</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-square.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
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
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body
    class="bg-brand-light dark:bg-slate-950 text-brand-dark dark:text-slate-100 font-sans antialiased min-h-screen flex items-center justify-center p-4 transition-colors duration-300">

    <div
        class="w-full max-w-4xl bg-white dark:bg-slate-900 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-800 overflow-hidden grid grid-cols-1 md:grid-cols-5 transition-colors duration-300">

        <div
            class="md:col-span-2 bg-slate-50 dark:bg-slate-950/40 p-6 md:p-8 flex flex-col justify-between border-b md:border-b-0 md:border-r border-slate-100 dark:border-slate-800">
            <div class="space-y-6">
                <a href="/"
                    class="inline-flex items-center gap-2 text-xs font-bold text-slate-400 hover:text-brand-blue transition">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog
                </a>
                <div
                    class="aspect-[4/3] bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 flex items-center justify-center overflow-hidden shadow-inner">
                    @if ($iphone->gambar)
                        <img src="{{ asset('uploads/iphones/' . $iphone->gambar) }}" class="w-full h-full object-cover">
                    @else
                        <i class="fa-solid fa-mobile-screen text-5xl text-slate-300 dark:text-slate-700"></i>
                    @endif
                </div>
                <div class="space-y-1">
                    <h2 class="text-2xl font-black font-fredoka text-slate-900 dark:text-white">
                        {{ $iphone->tipe_iphone }}</h2>
                    <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        {{ $iphone->kapasitas }} GB • {{ $iphone->warna }}</p>
                </div>
            </div>
            <div class="pt-6 border-t border-slate-200/60 dark:border-slate-800/80 mt-6 md:mt-0">
                <p class="text-xs text-slate-400 font-medium">Tarif Sewa Gadget</p>
                <p class="text-xl font-black text-brand-blue dark:text-blue-400 mt-0.5" id="tarif_dasar"
                    data-harga="{{ $iphone->harga_perhari }}">
                    Rp {{ number_format($iphone->harga_perhari, 0, ',', '.') }}<span
                        class="text-xs text-slate-400 dark:text-slate-500 font-normal">/hari</span>
                </p>
            </div>
        </div>

        <div class="md:col-span-3 p-6 md:p-8">
            <form action="{{ route('customer.booking.store', $iphone->id) }}" method="POST" class="space-y-5">
                @csrf
                <div class="space-y-1">
                    <h1 class="text-xl font-bold text-slate-800 dark:text-white font-fredoka">Lengkapi Formulir Sewa
                    </h1>
                    <p class="text-xs text-slate-400 dark:text-slate-500">Penyewa Aktif: <span
                            class="font-bold text-slate-600 dark:text-slate-300">{{ auth()->user()->name }}</span></p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nik"
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wide">NIK
                            KTP Resmi (16 Digit)</label>
                        <input type="text" name="nik" id="nik" maxlength="16" minlength="16"
                            value="{{ old('nik') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950/50 text-sm font-mono tracking-widest text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white dark:focus:bg-slate-900 transition-all"
                            placeholder="32xxxxxxxxxxxxxx" required>
                    </div>
                    <div>
                        <label for="no_hp"
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wide">No.
                            WhatsApp Aktif</label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950/50 text-sm text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white dark:focus:bg-slate-900 transition-all"
                            placeholder="Contoh: 08123456789" required>
                    </div>
                </div>

                <div>
                    <label for="alamat"
                        class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wide">Alamat
                        Domisili Sekarang</label>
                    <textarea name="alamat" id="alamat" rows="2"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950/50 text-sm text-slate-800 dark:text-white outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white dark:focus:bg-slate-900 transition-all resize-none"
                        placeholder="Masukkan alamat lengkap tempat tinggal Anda saat ini" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="tanggal_sewa"
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wide">Mulai
                            Ambil Sewa</label>
                        <input type="date" name="tanggal_sewa" id="tanggal_sewa"
                            value="{{ old('tanggal_sewa', date('Y-m-d')) }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950/50 text-sm text-slate-800 dark:text-white dark:[color-scheme:dark] outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white dark:focus:bg-slate-900 transition-all"
                            required>
                    </div>
                    <div>
                        <label for="tanggal_kembali"
                            class="block text-xs font-bold text-slate-500 dark:text-slate-400 mb-1.5 uppercase tracking-wide">Tanggal
                            Pengembalian</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                            value="{{ old('tanggal_kembali') }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950/50 text-sm text-slate-800 dark:text-white dark:[color-scheme:dark] outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white dark:focus:bg-slate-900 transition-all"
                            required>
                    </div>
                </div>

                <div
                    class="grid grid-cols-2 gap-4 p-4 rounded-xl bg-slate-50 dark:bg-slate-950/40 border border-slate-100 dark:border-slate-800/80 transition-colors duration-300">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Durasi Waktu</p>
                        <p class="text-base font-bold text-slate-700 dark:text-slate-300 font-fredoka"><span
                                id="lbl_hari">0</span> Hari</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Estimasi Tagihan Struk
                        </p>
                        <p class="text-base font-extrabold text-brand-blue dark:text-blue-400 font-fredoka">Rp <span
                                id="lbl_total">0</span></p>
                    </div>
                </div>

                @if ($errors->any())
                    <div
                        class="mb-5 p-4 rounded-xl bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 text-sm">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3 bg-brand-blue hover:bg-blue-700 text-white font-bold rounded-xl text-sm shadow-xl shadow-brand-blue/20 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-calendar-check"></i> Konfirmasi & Ajukan Booking
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tglSewa = document.getElementById('tanggal_sewa');
            const tglKembali = document.getElementById('tanggal_kembali');
            const lblHari = document.getElementById('lbl_hari');
            const lblTotal = document.getElementById('lbl_total');
            const hargaPerHari = parseInt(document.getElementById('tarif_dasar').getAttribute('data-harga'));

            function hitung() {
                if (tglSewa.value && tglKembali.value) {
                    const start = new Date(tglSewa.value);
                    const end = new Date(tglKembali.value);
                    const selisih = end.getTime() - start.getTime();
                    let hari = Math.ceil(selisih / (1000 * 3600 * 24));

                    if (hari <= 0) hari = 1;

                    lblHari.innerText = hari;
                    lblTotal.innerText = (hari * hargaPerHari).toLocaleString('id-ID');
                }
            }

            // Panggil hitung() saat halaman pertama dimuat untuk menangani data dari old()
            hitung();

            tglSewa.addEventListener('change', hitung);
            tglKembali.addEventListener('change', hitung);
        });
    </script>
</body>

</html>
