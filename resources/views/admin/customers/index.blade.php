@extends('layouts.admin')

@section('title', 'Data Customer')

@section('content')
<div class="space-y-6" data-aos="fade-up">
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Customer</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola data identitas pelanggan yang menyewa unit iPhone.</p>
        </div>
        <a href="{{ route('admin.customers.create') }}" class="px-5 py-2.5 bg-brand-blue text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 hover:bg-blue-700 transition flex items-center gap-2 transform hover:-translate-y-0.5">
            <i class="fa-solid fa-plus"></i> Tambah Customer
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[1000px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-400 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6 text-center w-16">No</th>
                        <th class="py-4 px-6 w-48">Identitas NIK</th>
                        <th class="py-4 px-6 min-w-[200px]">Nama Lengkap</th>
                        <th class="py-4 px-6 w-48">No. WhatsApp</th>
                        <th class="py-4 px-6 min-w-[250px]">Alamat</th>
                        <th class="py-4 px-6 text-center w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-gray-600">
                    @forelse($customers as $index => $customer)
                    <tr class="hover:bg-gray-50/70 transition align-middle">
                        <td class="py-4 px-6 text-center font-medium text-gray-400">{{ $index + 1 }}</td>
                        <td class="py-4 px-6 font-semibold text-gray-700">
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-md text-xs font-mono tracking-widest whitespace-nowrap">{{ $customer->nik }}</span>
                        </td>
                        <td class="py-4 px-6 font-bold text-gray-800 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-100 text-brand-blue flex-shrink-0 flex items-center justify-center font-bold text-sm">
                                    {{ strtoupper(substr($customer->nama_lengkap, 0, 1)) }}
                                </div>
                                <span>{{ $customer->nama_lengkap }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 font-medium text-gray-700 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <i class="fa-brands fa-whatsapp text-green-500 text-lg"></i> 
                                <span>{{ $customer->no_hp }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-gray-500">
                            <p class="line-clamp-2">{{ $customer->alamat }}</p>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.customers.edit', $customer->id) }}" class="w-8 h-8 flex items-center justify-center text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data pelanggan ini?')">
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
                        <td colspan="6" class="py-12 text-center text-gray-400">
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