@extends('layouts.admin')

@section('title', 'Data Transaksi Pembayaran')

@section('content')
<div class="space-y-6" data-aos="fade-up">
    
    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 flex items-center justify-between transition-colors duration-300">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Transaksi Pembayaran</h1>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Kelola pencatatan pembayaran dan cetak nota penyewaan.</p>
        </div>
        <a href="{{ route('admin.transaksis.create') }}" class="px-5 py-2.5 bg-brand-blue text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 hover:bg-blue-700 dark:hover:bg-blue-600 transition flex items-center gap-2 transform hover:-translate-y-0.5">
            <i class="fa-solid fa-cash-register"></i> Proses Pembayaran
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden transition-colors duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[1100px]">
                <thead>
                    <tr class="bg-gray-50 dark:bg-slate-900/50 border-b border-gray-100 dark:border-slate-800 text-gray-400 dark:text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6 text-center w-16">No</th>
                        <th class="py-4 px-6">Info Penyewa & Unit</th>
                        <th class="py-4 px-6">Tgl Bayar & Kasir</th>
                        <th class="py-4 px-6">Total Tagihan</th>
                        <th class="py-4 px-6">Jumlah Dibayar</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-slate-800/50 text-sm text-gray-600 dark:text-slate-300">
                    @forelse($transaksis as $index => $trx)
                    <tr class="hover:bg-gray-50/70 dark:hover:bg-slate-800/50 transition align-middle">
                        <td class="py-4 px-6 text-center font-medium text-gray-400 dark:text-slate-500">{{ $index + 1 }}</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-gray-800 dark:text-white whitespace-nowrap">{{ $trx->booking->customer->nama_lengkap }}</div>
                            <div class="text-xs text-brand-blue dark:text-blue-400 font-semibold mt-0.5">{{ $trx->booking->iphone->tipe_iphone }}</div>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="font-medium text-gray-700 dark:text-slate-300">{{ date('d M Y', strtotime($trx->tgl_bayar)) }}</div>
                            <div class="text-xs text-gray-400 dark:text-slate-500 mt-0.5"><i class="fa-solid fa-user-tie"></i> {{ $trx->user->name }}</div>
                        </td>
                        <td class="py-4 px-6 font-bold text-gray-800 dark:text-white whitespace-nowrap">Rp {{ number_format($trx->total_biaya, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 font-bold text-emerald-600 dark:text-emerald-400 whitespace-nowrap">Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 text-center">
                            @if($trx->status_pembayaran == 'Lunas')
                                <span class="px-3 py-1.5 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-full text-xs font-bold uppercase tracking-wide">Lunas</span>
                            @elseif($trx->status_pembayaran == 'Belum Lunas')
                                <span class="px-3 py-1.5 bg-amber-50 dark:bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-full text-xs font-bold uppercase tracking-wide">Belum Lunas</span>
                            @else
                                <span class="px-3 py-1.5 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 rounded-full text-xs font-bold uppercase tracking-wide">Pending</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.transaksis.show', $trx->id) }}" class="w-8 h-8 flex items-center justify-center text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded-lg transition" title="Lihat Nota">
                                    <i class="fa-solid fa-print"></i>
                                </a>
                                <form action="{{ route('admin.transaksis.destroy', $trx->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus riwayat pembayaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center text-red-600 dark:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-gray-400 dark:text-slate-500">
                            <div class="text-4xl mb-3"><i class="fa-solid fa-cash-register"></i></div>
                            <p class="text-sm font-medium">Belum ada riwayat transaksi pembayaran.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection