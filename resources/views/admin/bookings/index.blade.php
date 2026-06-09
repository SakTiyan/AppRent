@extends('layouts.admin')

@section('title', 'Data Booking')

@section('content')
    <div class="space-y-6" data-aos="fade-up">

        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 transition-colors duration-300">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Data Booking</h1>
                <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Kelola transaksi penyewaan unit iPhone oleh pelanggan.</p>
            </div>
            <a href="{{ route('admin.bookings.create') }}"
                class="px-5 py-2.5 bg-brand-blue text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 hover:bg-blue-700 dark:hover:bg-blue-600 transition flex items-center gap-2 transform hover:-translate-y-0.5">
                <i class="fa-solid fa-plus"></i> Tambah Booking
            </a>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden transition-colors duration-300">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[1000px]">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-slate-900/50 border-b border-gray-100 dark:border-slate-800 text-gray-400 dark:text-slate-500 text-xs font-bold uppercase tracking-wider">
                            <th class="py-4 px-6 text-center w-16">No</th>
                            <th class="py-4 px-6 min-w-[180px]">Pelanggan</th>
                            <th class="py-4 px-6 min-w-[180px]">Unit iPhone</th>
                            <th class="py-4 px-6">Tgl Sewa - Kembali</th>
                            <th class="py-4 px-6">Total Harga</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-slate-800/50 text-sm text-gray-600 dark:text-slate-300">
                        @forelse($bookings as $index => $booking)
                            <tr class="hover:bg-gray-50/70 dark:hover:bg-slate-800/50 transition align-middle">
                                <td class="py-4 px-6 text-center font-medium text-gray-400 dark:text-slate-500">{{ $index + 1 }}</td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-gray-800 dark:text-white whitespace-nowrap">{{ $booking->customer->nama_lengkap }}</div>
                                    <div class="text-xs text-gray-400 dark:text-slate-400 mt-0.5"><i class="fa-brands fa-whatsapp text-green-500"></i> {{ $booking->customer->no_hp }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-brand-blue dark:text-blue-400 whitespace-nowrap">{{ $booking->iphone->tipe_iphone }}</div>
                                    <div class="text-xs text-gray-400 dark:text-slate-400 mt-0.5 capitalize">{{ $booking->iphone->warna }} • {{ $booking->iphone->kapasitas }} GB</div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="font-medium text-gray-700 dark:text-slate-300">
                                        {{ date('d M Y', strtotime($booking->tgl_sewa)) }} <span class="text-gray-400 mx-1">➔</span> {{ date('d M Y', strtotime($booking->tgl_kembali)) }}
                                    </div>
                                    <div class="text-xs text-amber-600 dark:text-brand-amber font-semibold mt-1">
                                        <i class="fa-regular fa-clock"></i> {{ $booking->total_hari }} Hari
                                    </div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="font-bold text-gray-800 dark:text-white">
                                        Rp {{ number_format($booking->total_hari * $booking->iphone->harga_perhari, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if ($booking->status_booking == 'Aktif')
                                        <span class="px-3 py-1.5 bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded-full text-xs font-bold uppercase tracking-wide">Aktif</span>
                                    @elseif($booking->status_booking == 'Selesai')
                                        <span class="px-3 py-1.5 bg-green-50 dark:bg-emerald-500/10 text-green-600 dark:text-emerald-400 rounded-full text-xs font-bold uppercase tracking-wide">Selesai</span>
                                    @else
                                        <span class="px-3 py-1.5 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 rounded-full text-xs font-bold uppercase tracking-wide">Batal</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="w-8 h-8 flex items-center justify-center text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded-lg transition" title="Lihat Detail Transaksi">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="w-8 h-8 flex items-center justify-center text-amber-600 dark:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 rounded-lg transition" title="Edit Status">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus riwayat booking ini?')">
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
                                    <div class="text-4xl mb-3"><i class="fa-solid fa-clipboard-list"></i></div>
                                    <p class="text-sm font-medium">Belum ada transaksi penyewaan iPhone.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection