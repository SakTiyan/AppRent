@extends('layouts.admin')

@section('title', 'Detail Transaksi Booking')

@section('content')
<div class="max-w-4xl mx-auto space-y-6" data-aos="fade-up">

    <div class="flex items-center gap-3">
        <a href="{{ route('admin.bookings.index') }}" class="p-2 bg-white hover:bg-gray-100 rounded-xl border border-gray-200 transition text-gray-500" title="Kembali">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Transaksi #INV-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</h1>
            <p class="text-sm text-gray-500 mt-1">Rincian lengkap data penyewa, unit gadget, dan tagihan.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-4 flex items-center justify-between border-b border-gray-100 
            @if ($booking->status_booking == 'Aktif') bg-blue-50 
            @elseif($booking->status_booking == 'Selesai') bg-green-50 
            @else bg-red-50 @endif">
            <span class="font-bold text-gray-700">Status Transaksi:</span>
            @if ($booking->status_booking == 'Aktif')
                <span class="px-4 py-1.5 bg-blue-500 text-white rounded-full text-xs font-bold uppercase tracking-wide shadow-sm">🔵 Sedang Disewa</span>
            @elseif($booking->status_booking == 'Selesai')
                <span class="px-4 py-1.5 bg-green-500 text-white rounded-full text-xs font-bold uppercase tracking-wide shadow-sm">🟢 Selesai / Dikembalikan</span>
            @else
                <span class="px-4 py-1.5 bg-red-500 text-white rounded-full text-xs font-bold uppercase tracking-wide shadow-sm">🔴 Dibatalkan</span>
            @endif
        </div>

        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8 border-b border-gray-100">
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Informasi Penyewa</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Nama Lengkap</p>
                        <p class="font-bold text-gray-800 text-lg">{{ $booking->customer->nama_lengkap }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Nomor Induk Kependudukan (NIK)</p>
                        <p class="font-mono font-medium text-gray-700 bg-gray-50 px-2 py-1 rounded inline-block mt-1">{{ $booking->customer->nik }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">No. WhatsApp</p>
                        <p class="font-medium text-gray-800"><i class="fa-brands fa-whatsapp text-green-500 mr-1"></i> {{ $booking->customer->no_hp }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Alamat Domisili</p>
                        <p class="font-medium text-gray-800">{{ $booking->customer->alamat }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Unit yang Disewa</h3>
                <div class="flex gap-4 items-start bg-gray-50 p-4 rounded-xl border border-gray-100">
                    <div class="w-20 h-20 bg-white rounded-lg border border-gray-200 flex items-center justify-center overflow-hidden flex-shrink-0">
                        @if ($booking->iphone->gambar && file_exists(public_path('uploads/iphones/' . $booking->iphone->gambar)))
                            <img src="{{ asset('uploads/iphones/' . $booking->iphone->gambar) }}" alt="Gambar" class="w-full h-full object-cover">
                        @else
                            <i class="fa-solid fa-mobile-screen text-3xl text-gray-300"></i>
                        @endif
                    </div>
                    <div>
                        <p class="font-bold text-brand-blue text-lg">{{ $booking->iphone->tipe_iphone }}</p>
                        <p class="text-sm text-gray-600 font-medium mt-1">Kapasitas: {{ $booking->iphone->kapasitas }} GB</p>
                        <p class="text-sm text-gray-600 font-medium capitalize">Warna: {{ $booking->iphone->warna }}</p>
                        <p class="text-xs font-semibold text-gray-400 mt-2">Tarif: Rp {{ number_format($booking->iphone->harga_perhari, 0, ',', '.') }} / hari</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8 bg-slate-50">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5">Rincian Sewa & Tagihan</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Tanggal Sewa</p>
                    <p class="font-bold text-gray-800">{{ date('d M Y', strtotime($booking->tgl_sewa)) }}</p>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Tanggal Kembali</p>
                    <p class="font-bold text-gray-800">{{ date('d M Y', strtotime($booking->tgl_kembali)) }}</p>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <p class="text-xs text-gray-500 mb-1">Durasi</p>
                    <p class="font-bold text-gray-800">{{ $booking->total_hari }} Hari</p>
                </div>
                <div class="bg-brand-blue p-4 rounded-xl shadow-md border border-blue-600 text-white">
                    <p class="text-xs text-blue-200 mb-1">Total Tagihan</p>
                    <p class="font-black text-xl">
                        Rp {{ number_format($booking->total_hari * $booking->iphone->harga_perhari, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection