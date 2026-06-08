@extends('layouts.admin')

@section('title', 'Tambah Transaksi Booking')

@section('content')
<div class="max-w-2xl mx-auto space-y-6" data-aos="fade-up">
    
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.bookings.index') }}" class="p-2 bg-white hover:bg-gray-100 rounded-xl border border-gray-200 transition text-gray-500" title="Kembali">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Transaksi Sewa</h1>
            <p class="text-sm text-gray-500 mt-1">Daftarkan transaksi penyewaan unit iPhone baru.</p>
        </div>
    </div>

    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.bookings.store') }}" method="POST">
            @csrf
            
            <div class="mb-5">
                <label for="customer_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Pelanggan / Customer</label>
                <select name="customer_id" id="customer_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white font-medium text-gray-700" required>
                    <option value="">-- Pilih Customer --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->nama_lengkap }} (NIK: {{ $customer->nik }})
                        </option>
                    @endforeach
                </select>
                @error('customer_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-5">
                <label for="iphone_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Unit iPhone (Hanya yang Tersedia)</label>
                <select name="iphone_id" id="iphone_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white font-medium text-gray-700" required>
                    <option value="">-- Pilih Unit iPhone --</option>
                    @foreach($iphones as $iphone)
                        <option value="{{ $iphone->id }}" data-harga="{{ $iphone->harga_perhari }}" {{ old('iphone_id') == $iphone->id ? 'selected' : '' }}>
                            {{ $iphone->tipe_iphone }} {{ $iphone->kapasitas }}GB - Rp {{ number_format($iphone->harga_perhari, 0, ',', '.') }} / hari
                        </option>
                    @endforeach
                </select>
                @error('iphone_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                <div>
                    <label for="tanggal_sewa" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai Sewa</label>
                    <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="w-full px-4 py-3 rounded-xl border @error('tanggal_sewa') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white font-medium text-gray-700" value="{{ old('tanggal_sewa', date('Y-m-d')) }}" required>
                    @error('tanggal_sewa') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tanggal_kembali" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Selesai Sewa</label>
                    <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="w-full px-4 py-3 rounded-xl border @error('tanggal_kembali') border-red-400 @else border-gray-200 @enderror focus:ring-2 focus:ring-brand-blue focus:border-brand-blue transition-all outline-none bg-gray-50 focus:bg-white font-medium text-gray-700" value="{{ old('tanggal_kembali') }}" required>
                    @error('tanggal_kembali') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8 bg-slate-50 p-4 rounded-xl border border-slate-100">
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Durasi Sewa</p>
                    <div class="text-xl font-bold text-slate-700"><span id="display_durasi">0</span> Hari</div>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Estimasi Total Bayar</p>
                    <div class="text-xl font-extrabold text-brand-blue">Rp <span id="display_total">0</span></div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                <a href="{{ route('admin.bookings.index') }}" class="px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-sm font-bold transition">Batal</a>
                <button type="submit" class="px-6 py-3 bg-brand-blue hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 transition">Simpan Transaksi</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const iphoneSelect = document.getElementById('iphone_id');
        const tglSewaInput = document.getElementById('tanggal_sewa');
        const tglKembaliInput = document.getElementById('tanggal_kembali');
        
        const displayDurasi = document.getElementById('display_durasi');
        const displayTotal = document.getElementById('display_total');

        function hitungTotal() {
            const tglSewa = new Date(tglSewaInput.value);
            const tglKembali = new Date(tglKembaliInput.value);
            const selectedIphone = iphoneSelect.options[iphoneSelect.selectedIndex];
            
            if(tglSewaInput.value && tglKembaliInput.value && selectedIphone.value) {
                const hargaPerHari = parseInt(selectedIphone.getAttribute('data-harga'));
                const selisihWaktu = tglKembali.getTime() - tglSewa.getTime();
                let selisihHari = Math.ceil(selisihWaktu / (1000 * 3600 * 24));
                if(selisihHari <= 0) selisihHari = 1;

                const totalHarga = selisihHari * hargaPerHari;

                displayDurasi.innerText = selisihHari;
                displayTotal.innerText = totalHarga.toLocaleString('id-ID');
            } else {
                displayDurasi.innerText = '0';
                displayTotal.innerText = '0';
            }
        }

        iphoneSelect.addEventListener('change', hitungTotal);
        tglSewaInput.addEventListener('change', hitungTotal);
        tglKembaliInput.addEventListener('change', hitungTotal);
    });
</script>
@endsection