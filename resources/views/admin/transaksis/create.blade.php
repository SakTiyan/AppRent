@extends('layouts.admin')

@section('title', 'Proses Pembayaran')

@section('content')
<div class="max-w-2xl mx-auto space-y-6" data-aos="fade-up">
    
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.transaksis.index') }}" class="p-2 bg-white dark:bg-slate-900 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-xl border border-gray-200 dark:border-slate-800 transition text-gray-500 dark:text-slate-400" title="Kembali">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Proses Pembayaran</h1>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Terima pembayaran dari transaksi booking yang belum lunas.</p>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900 p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 transition-colors duration-300">
        <form action="{{ route('admin.transaksis.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label for="booking_id" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Pilih Transaksi Booking</label>
                <select name="booking_id" id="booking_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-slate-700 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 dark:bg-slate-950/50 focus:bg-white dark:focus:bg-slate-900 font-medium text-gray-700 dark:text-slate-300" required>
                    <option value="" data-tagihan="0">-- Pilih Booking yang Belum Dibayar --</option>
                    @foreach($bookings as $b)
                        <option value="{{ $b->id }}" data-tagihan="{{ $b->sisa_tagihan }}">
                            {{ $b->customer->nama_lengkap }} | {{ $b->iphone->tipe_iphone }} | Sisa Tagihan: Rp {{ number_format($b->sisa_tagihan, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('booking_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                <div>
                    <label for="tgl_bayar" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Tanggal Pembayaran</label>
                    <input type="date" name="tgl_bayar" id="tgl_bayar" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-slate-700 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 dark:bg-slate-950/50 focus:bg-white dark:focus:bg-slate-900 font-medium text-gray-700 dark:text-white dark:[color-scheme:dark]" value="{{ date('Y-m-d') }}" required>
                </div>

                <div>
                    <label for="jumlah_bayar" class="block text-sm font-semibold text-gray-700 dark:text-slate-300 mb-2">Uang yang Diterima (Rp)</label>
                    <input type="number" name="jumlah_bayar" id="jumlah_bayar" class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-slate-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none bg-emerald-50/10 dark:bg-emerald-50/5 focus:bg-white dark:focus:bg-slate-900 font-bold text-gray-800 dark:text-white placeholder-gray-400 dark:placeholder-slate-500" placeholder="Contoh: 150000" required>
                    @error('jumlah_bayar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="bg-slate-800 dark:bg-slate-950 p-6 rounded-xl border border-slate-700 dark:border-slate-800 mb-8 text-white flex flex-col md:flex-row gap-6 justify-between items-center shadow-inner transition-colors duration-300">
                <div>
                    <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Total Tagihan Sistem</p>
                    <div class="text-2xl font-bold">Rp <span id="display_tagihan">0</span></div>
                </div>
                <div class="hidden md:block w-px h-12 bg-slate-600 dark:bg-slate-800"></div>
                <div class="text-right w-full md:w-auto">
                    <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Kembalian / Kekurangan</p>
                    <div class="text-2xl font-black text-emerald-400">Rp <span id="display_kembalian">0</span></div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 dark:border-slate-800 pt-6">
                <a href="{{ route('admin.transaksis.index') }}" class="px-5 py-3 bg-gray-100 dark:bg-slate-800 hover:bg-gray-200 dark:hover:bg-slate-700 text-gray-600 dark:text-slate-300 rounded-xl text-sm font-bold transition">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-blue hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 transition">
                    <i class="fa-solid fa-check mr-1"></i> Selesaikan Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookingSelect = document.getElementById('booking_id');
        const jumlahBayarInput = document.getElementById('jumlah_bayar');
        const displayTagihan = document.getElementById('display_tagihan');
        const displayKembalian = document.getElementById('display_kembalian');

        function hitungKembalian() {
            const selectedOption = bookingSelect.options[bookingSelect.selectedIndex];
            const tagihan = parseInt(selectedOption.getAttribute('data-tagihan')) || 0;
            const bayar = parseInt(jumlahBayarInput.value) || 0;
            
            const kembalian = bayar - tagihan;

            displayTagihan.innerText = tagihan.toLocaleString('id-ID');
            
            if(kembalian < 0) {
                displayKembalian.parentElement.classList.remove('text-emerald-400');
                displayKembalian.parentElement.classList.add('text-red-400');
            } else {
                displayKembalian.parentElement.classList.remove('text-red-400');
                displayKembalian.parentElement.classList.add('text-emerald-400');
            }

            displayKembalian.innerText = kembalian.toLocaleString('id-ID');
        }

        bookingSelect.addEventListener('change', hitungKembalian);
        jumlahBayarInput.addEventListener('input', hitungKembalian);
    });
</script>
@endsection