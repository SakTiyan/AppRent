@extends('layouts.admin')

@section('title', 'Kelola Data iPhone')

@section('content')
<div class="space-y-6" data-aos="fade-up">

    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col md:flex-row items-center justify-between gap-4 transition-colors duration-300">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Kelola Data iPhone</h1>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Daftar unit iPhone inventaris toko yang siap disewakan.</p>
        </div>
        <a href="{{ route('admin.iphones.create') }}"
            class="px-5 py-2.5 bg-brand-blue text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 hover:bg-blue-700 transition flex items-center gap-2 transform hover:-translate-y-0.5">
            <i class="fa-solid fa-plus"></i> Tambah iPhone
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden transition-colors duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-slate-900/50 border-b border-gray-100 dark:border-slate-800 text-gray-400 dark:text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6 text-center w-16">No</th>
                        <th class="py-4 px-6 text-center w-24">Gambar</th>
                        <th class="py-4 px-6">Tipe iPhone</th>
                        <th class="py-4 px-6">Kapasitas</th>
                        <th class="py-4 px-6">Warna</th>
                        <th class="py-4 px-6">Harga / Hari</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-slate-800/50 text-sm text-gray-600 dark:text-slate-300">
                    @forelse($iphones as $index => $iphone)
                        <tr class="hover:bg-gray-50/70 dark:hover:bg-slate-800/50 transition">
                            <td class="py-4 px-6 text-center font-medium text-gray-400 dark:text-slate-500">{{ $index + 1 }}</td>
                            <td class="py-4 px-6 text-center">
                                <div class="w-14 h-14 rounded-xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center mx-auto border border-gray-200 dark:border-slate-700 overflow-hidden shadow-sm">
                                    @if ($iphone->gambar)
                                        <img src="{{ asset('uploads/iphones/' . $iphone->gambar) }}" alt="Gambar" class="w-full h-full object-cover">
                                    @else
                                        <i class="fa-solid fa-mobile-screen text-2xl text-gray-300 dark:text-slate-600"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-6 font-bold text-gray-800 dark:text-white">{{ $iphone->tipe_iphone }}</td>
                            <td class="py-4 px-6 font-medium">{{ $iphone->kapasitas }} GB</td>
                            <td class="py-4 px-6 font-medium capitalize">{{ $iphone->warna }}</td>
                            <td class="py-4 px-6 font-semibold text-gray-800 dark:text-brand-blue">Rp {{ number_format($iphone->harga_perhari, 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-center">
                                @if ($iphone->status == 'Tersedia')
                                    <span class="px-3 py-1.5 bg-green-50 dark:bg-emerald-500/10 text-green-600 dark:text-emerald-400 rounded-full text-[10px] font-bold uppercase tracking-wide">Tersedia</span>
                                @elseif($iphone->status == 'Disewa')
                                    <span class="px-3 py-1.5 bg-yellow-50 dark:bg-amber-500/10 text-yellow-600 dark:text-amber-400 rounded-full text-[10px] font-bold uppercase tracking-wide">Disewa</span>
                                @else
                                    <span class="px-3 py-1.5 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 rounded-full text-[10px] font-bold uppercase tracking-wide">Maintenance</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center flex items-center justify-center gap-2">
                                <a href="{{ route('admin.iphones.show', $iphone->id) }}" class="p-2 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-500/10 rounded-lg transition" title="Lihat Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.iphones.edit', $iphone->id) }}" class="p-2 text-amber-600 dark:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 rounded-lg transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.iphones.destroy', $iphone->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus unit iPhone ini dari sistem?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 dark:text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-lg transition" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-gray-400 dark:text-slate-500">
                                <div class="text-4xl mb-3"><i class="fa-solid fa-mobile-button"></i></div>
                                <p class="text-sm font-medium">Belum ada unit iPhone yang didaftarkan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection