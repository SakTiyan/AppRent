@extends('layouts.admin')

@section('title', 'Data Transaksi Pembayaran')

@section('content')
<div class="space-y-6" data-aos="fade-up">
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Transaksi Pembayaran</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola pencatatan pembayaran dan cetak nota penyewaan.</p>
        </div>
        <a href="{{ route('admin.transaksis.create') }}" class="px-5 py-2.5 bg-brand-blue text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 hover:bg-blue-700 transition flex items-center gap-2 transform hover:-translate-y-0.5">
            <i class="fa-solid fa-cash-register"></i> Proses Pembayaran
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[1100px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-400 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6 text-center w-16">No</th>
                        <th class="py-4 px-6">Info Penyewa & Unit</th>
                        <th class="py-4 px-6">Tgl Bayar & Kasir</th>
                        <th class="py-4 px-6">Total Tagihan</th>
                        <th class="py-4 px-6">Jumlah Dibayar</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-gray-600">
                    @forelse($transaksis as $index => $trx)
                    <tr class="hover:bg-gray-50/70 transition align-middle">
                        <td class="py-4 px-6 text-center font-medium text-gray-400">{{ $index + 1 }}</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-gray-800 whitespace-nowrap">{{ $trx->booking->customer->nama_lengkap }}</div>
                            <div class="text-xs text-brand-blue font-semibold mt-0.5">{{ $trx->booking->iphone->tipe_iphone }}</div>
                        </td>
                        <td class="py-4 px-6 whitespace-nowrap">
                            <div class="font-medium text-gray-700">{{ date('d M Y', strtotime($trx->tgl_bayar)) }}</div>
                            <div class="text-xs text-gray-400 mt-0.5"><i class="fa-solid fa-user-tie"></i> {{ $trx->user->name }}</div>
                        </td>
                        <td class="py-4 px-6 font-bold text-gray-800 whitespace-nowrap">Rp {{ number_format($trx->total_biaya, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 font-bold text-emerald-600 whitespace-nowrap">Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}</td>
                        <td class="py-4 px-6 text-center">
                            @if($trx->status_pembayaran == 'Lunas')
                                <span class="px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold uppercase tracking-wide">Lunas</span>
                            @else
                                <span class="px-3 py-1.5 bg-red-50 text-red-600 rounded-full text-xs font-bold uppercase tracking-wide">Belum Lunas</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.transaksis.show', $trx->id) }}" class="w-8 h-8 flex items-center justify-center text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat Nota">
                                    <i class="fa-solid fa-print"></i>
                                </a>
                                <form action="{{ route('admin.transaksis.destroy', $trx->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus riwayat pembayaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center text-gray-400">
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