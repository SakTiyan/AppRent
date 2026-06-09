@extends('layouts.admin')

@section('title', 'Nota Pembayaran')

@section('content')
<div class="max-w-3xl mx-auto space-y-6" data-aos="fade-up">
    
    <div class="flex items-center justify-between mb-4 print:hidden">
        <a href="{{ route('admin.transaksis.index') }}" class="px-4 py-2 bg-white dark:bg-slate-900 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg border border-gray-200 dark:border-slate-800 transition text-gray-600 dark:text-slate-400 text-sm font-semibold flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <button onclick="window.print()" class="px-5 py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-lg text-sm font-bold shadow-md transition flex items-center gap-2">
            <i class="fa-solid fa-print"></i> Cetak Nota
        </button>
    </div>

    <div class="bg-white dark:bg-slate-900 p-8 md:p-12 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 relative overflow-hidden transition-colors duration-300" id="area-nota">
        
        <div class="absolute top-12 right-12 transform rotate-12 opacity-20 dark:opacity-10 pointer-events-none select-none">
            @if($transaksi->status_pembayaran == 'Lunas')
                <span class="text-6xl font-black text-emerald-600 border-8 border-emerald-600 px-6 py-2 rounded-xl">LUNAS</span>
            @else
                <span class="text-6xl font-black text-red-600 border-8 border-red-600 px-6 py-2 rounded-xl">BELUM LUNAS</span>
            @endif
        </div>

        <div class="text-center border-b-2 border-gray-100 dark:border-slate-800 pb-8 mb-8">
            <h1 class="text-3xl font-black text-brand-blue dark:text-blue-400 mb-1">AppRent Invoice</h1>
            <p class="text-sm text-gray-500 dark:text-slate-400">Pusat Penyewaan Gadget Terpercaya</p>
            <p class="text-xs text-gray-400 dark:text-slate-500 mt-2 font-mono">No. Nota: #INV-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>

        <div class="grid grid-cols-2 gap-8 border-b border-gray-100 dark:border-slate-800 pb-8 mb-8">
            <div>
                <p class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest mb-2">Informasi Pelanggan</p>
                <p class="font-bold text-gray-800 dark:text-white text-lg">{{ $transaksi->booking->customer->nama_lengkap }}</p>
                <p class="text-sm text-gray-600 dark:text-slate-300 font-medium mt-0.5"><i class="fa-brands fa-whatsapp text-green-500"></i> {{ $transaksi->booking->customer->no_hp }}</p>
                <p class="text-sm text-gray-500 dark:text-slate-400 mt-2 max-w-[250px] text-justify">{{ $transaksi->booking->customer->alamat }}</p>
            </div>
            <div class="text-right">
                <p class="text-xs font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest mb-2">Detail Transaksi</p>
                <p class="text-sm text-gray-600 dark:text-slate-300"><span class="font-semibold text-gray-400">Tanggal Bayar:</span> {{ date('d M Y', strtotime($transaksi->tgl_bayar)) }}</p>
                <p class="text-sm text-gray-600 dark:text-slate-300 mt-1"><span class="font-semibold text-gray-400">Kasir:</span> {{ $transaksi->user->name }}</p>
                <p class="text-sm text-gray-600 dark:text-slate-300 mt-1"><span class="font-semibold text-gray-400">Durasi Sewa:</span> {{ $transaksi->booking->total_hari }} Hari</p>
            </div>
        </div>

        <div class="mb-8">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-slate-700">
                        <th class="py-3 text-sm font-bold text-gray-700 dark:text-slate-300">Deskripsi Unit Gadget</th>
                        <th class="py-3 text-sm font-bold text-gray-700 dark:text-slate-300 text-right">Tarif / Hari</th>
                        <th class="py-3 text-sm font-bold text-gray-700 dark:text-slate-300 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-600 dark:text-slate-300">
                    <tr class="border-b border-gray-100 dark:border-slate-800/60">
                        <td class="py-4 font-semibold text-gray-800 dark:text-white">
                            {{ $transaksi->booking->iphone->tipe_iphone }} ({{ $transaksi->booking->iphone->kapasitas }} GB - {{ $transaksi->booking->iphone->warna }})
                            <br><span class="font-normal text-gray-400 dark:text-slate-500 text-xs mt-1 block">Masa Sewa: {{ date('d/m/Y', strtotime($transaksi->booking->tgl_sewa)) }} s/d {{ date('d/m/Y', strtotime($transaksi->booking->tgl_kembali)) }}</span>
                        </td>
                        <td class="py-4 text-right font-mono text-gray-500 dark:text-slate-400">Rp {{ number_format($transaksi->booking->iphone->harga_perhari, 0, ',', '.') }}</td>
                        <td class="py-4 text-right font-mono font-bold text-gray-800 dark:text-white">Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="w-full md:w-1/2 ml-auto space-y-3 text-sm">
            <div class="flex justify-between text-gray-600 dark:text-slate-400">
                <span>Total Tagihan:</span>
                <span class="font-bold text-gray-800 dark:text-white font-mono">Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-gray-600 dark:text-slate-400">
                <span>Uang Tunai Dibayar:</span>
                <span class="font-bold text-emerald-600 dark:text-emerald-400 font-mono">Rp {{ number_format($transaksi->jumlah_bayar, 0, ',', '.') }}</span>
            </div>
            <div class="border-t border-gray-200 dark:border-slate-700 pt-3 flex justify-between text-lg font-black">
                @php $kembalian = $transaksi->jumlah_bayar - $transaksi->total_biaya; @endphp
                @if($kembalian < 0)
                    <span class="text-red-500">Kurang Bayar:</span>
                    <span class="text-red-500 font-mono">Rp {{ number_format(abs($kembalian), 0, ',', '.') }}</span>
                @else
                    <span class="text-gray-800 dark:text-white">Kembalian:</span>
                    <span class="text-gray-800 dark:text-emerald-400 font-mono">Rp {{ number_format($kembalian, 0, ',', '.') }}</span>
                @endif
            </div>
        </div>

        <div class="mt-12 text-center text-xs text-gray-400 dark:text-slate-500">
            <p>Terima kasih telah mempercayakan kebutuhan gadget Anda kepada kami.</p>
            <p class="mt-1">Harap simpan nota ini sebagai bukti transaksi yang sah.</p>
        </div>

    </div>
</div>

<style>
    @media print {
        body * { visibility: hidden; }
        #area-nota, #area-nota * { visibility: visible; }
        #area-nota { position: absolute; left: 0; top: 0; width: 100%; box-shadow: none; border: none; background: white !important; color: black !important; }
        #area-nota * { color: black !important; }
    }
</style>
@endsection