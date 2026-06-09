@extends('layouts.admin')

@section('title', 'Data Customer')

@section('content')
<div class="space-y-6" data-aos="fade-up">
    
    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 transition-colors duration-300">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Data Customer</h1>
            <p class="text-sm text-gray-500 dark:text-slate-400 mt-1">Kelola data identitas pelanggan yang menyewa unit iPhone.</p>
        </div>
        <a href="{{ route('admin.customers.create') }}" class="px-5 py-2.5 bg-brand-blue text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 hover:bg-blue-700 dark:hover:bg-blue-600 transition flex items-center gap-2 transform hover:-translate-y-0.5">
            <i class="fa-solid fa-plus"></i> Tambah Customer
        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden transition-colors duration-300">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[1000px]">
                <thead>
                    <tr class="bg-gray-50 dark:bg-slate-900/50 border-b border-gray-100 dark:border-slate-800 text-gray-400 dark:text-slate-500 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6 text-center w-16">No</th>
                        <th class="py-4 px-6 w-48">Identitas NIK</th>
                        <th class="py-4 px-6 min-w-[200px]">Nama Lengkap</th>
                        <th class="py-4 px-6 w-48">No. WhatsApp</th>
                        <th class="py-4 px-6 min-w-[250px]">Alamat</th>
                        <th class="py-4 px-6 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-slate-800/50 text-sm text-gray-600 dark:text-slate-300">
                    @forelse($customers as $index => $customer)
                    <tr class="hover:bg-gray-50/70 dark:hover:bg-slate-800/50 transition align-middle">
                        <td class="py-4 px-6 text-center font-medium text-gray-400 dark:text-slate-500">{{ $index + 1 }}</td>
                        <td class="py-4 px-6 font-semibold text-gray-700 dark:text-slate-300">
                            <span class="px-3 py-1 bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-slate-400 rounded-md text-xs font-mono tracking-widest whitespace-nowrap border border-transparent dark:border-slate-700/50">{{ $customer->nik }}</span>
                        </td>
                        <td class="py-4 px-6 font-bold text-gray-800 dark:text-white whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-100 dark:bg-blue-500/10 text-brand-blue dark:text-blue-400 flex-shrink-0 flex items-center justify-center font-bold text-sm">
                                    {{ strtoupper(substr($customer->nama_lengkap, 0, 1)) }}
                                </div>
                                <span>{{ $customer->nama_lengkap }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-700 dark:text-slate-300 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <i class="fa-brands fa-whatsapp text-green-500 text-lg"></i> 
                                <span>{{ $customer->no_hp }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-gray-500 dark:text-slate-400">
                            <p class="line-clamp-2">{{ $customer->alamat }}</p>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.customers.edit', $customer->id) }}" class="w-8 h-8 flex items-center justify-center text-amber-600 dark:text-amber-500 hover:bg-amber-50 dark:hover:bg-amber-500/10 rounded-lg transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data pelanggan ini?')">
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
                        <td colspan="6" class="py-12 text-center text-gray-400 dark:text-slate-500">
                            <div class="text-4xl mb-3"><i class="fa-regular fa-address-card"></i></div>
                            <p class="text-sm font-medium">Belum ada data pelanggan yang terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection