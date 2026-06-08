@extends('layouts.admin')

@section('title', 'Data Booking')

@section('content')
    <div class="space-y-6" data-aos="fade-up">

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Booking</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola transaksi penyewaan unit iPhone oleh pelanggan.</p>
            </div>
            <a href="{{ route('admin.bookings.create') }}"
                class="px-5 py-2.5 bg-brand-blue text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 hover:bg-blue-700 transition flex items-center gap-2 transform hover:-translate-y-0.5">
                <i class="fa-solid fa-plus"></i> Tambah Booking
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[1000px]">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-gray-400 text-xs font-bold uppercase tracking-wider">
                            <th class="py-4 px-6 text-center w-16">No</th>
                            <th class="py-4 px-6 min-w-[180px]">Pelanggan</th>
                            <th class="py-4 px-6 min-w-[180px]">Unit iPhone</th>
                            <th class="py-4 px-6">Tgl Sewa - Kembali</th>
                            <th class="py-4 px-6">Total Harga</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-center w-32">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm text-gray-600">
                        @forelse($bookings as $index => $booking)
                            <tr class="hover:bg-gray-50/70 transition align-middle">
                                <td class="py-4 px-6 text-center font-medium text-gray-400">{{ $index + 1 }}</td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-gray-800 whitespace-nowrap">{{ $booking->customer->nama_lengkap }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5"><i class="fa-brands fa-whatsapp text-green-500"></i> {{ $booking->customer->no_hp }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-brand-blue whitespace-nowrap">{{ $booking->iphone->tipe_iphone }}</div>
                                    <div class="text-xs text-gray-400 mt-0.5 capitalize">{{ $booking->iphone->warna }} • {{ $booking->iphone->kapasitas }} GB</div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="font-medium text-gray-700">
                                        {{ date('d M Y', strtotime($booking->tgl_sewa)) }} <span class="text-gray-400 mx-1">➔</span> {{ date('d M Y', strtotime($booking->tgl_kembali)) }}
                                    </div>
                                    <div class="text-xs text-amber-600 font-semibold mt-1">
                                        <i class="fa-regular fa-clock"></i> {{ $booking->total_hari }} Hari
                                    </div>
                                </td>
                                <td class="py-4 px-6 whitespace-nowrap">
                                    <div class="font-bold text-gray-800">
                                        Rp {{ number_format($booking->total_hari * $booking->iphone->harga_perhari, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if ($booking->status_booking == 'Aktif')
                                        <span class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-full text-xs font-bold uppercase tracking-wide">Aktif</span>
                                    @elseif($booking->status_booking == 'Selesai')
                                        <span class="px-3 py-1.5 bg-green-50 text-green-600 rounded-full text-xs font-bold uppercase tracking-wide">Selesai</span>
                                    @else
                                        <span class="px-3 py-1.5 bg-red-50 text-red-600 rounded-full text-xs font-bold uppercase tracking-wide">Batal</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="w-8 h-8 flex items-center justify-center text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat Detail Transaksi">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="w-8 h-8 flex items-center justify-center text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Edit Status">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus riwayat booking ini?')">
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