@extends('layouts.admin')

@section('title', 'Kelola Data Kasir')

@section('content')
<div class="space-y-6" data-aos="fade-up">
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Data Kasir</h1>
            <p class="text-sm text-gray-500 mt-1">Daftar akun karyawan yang memiliki hak akses sebagai Kasir toko.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="px-5 py-2.5 bg-brand-blue text-white rounded-xl text-sm font-bold shadow-lg shadow-brand-blue/30 hover:bg-blue-700 transition flex items-center gap-2 transform hover:-translate-y-0.5">
            <i class="fa-solid fa-user-plus"></i> Tambah Kasir
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-400 text-xs font-bold uppercase tracking-wider">
                        <th class="py-4 px-6 text-center w-16">No</th>
                        <th class="py-4 px-6">Nama Lengkap</th>
                        <th class="py-4 px-6">Alamat Email</th>
                        <th class="py-4 px-6">Role Akses</th>
                        <th class="py-4 px-6 text-center w-40">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm text-gray-600">
                    @forelse($kasirs as $index => $kasir)
                    <tr class="hover:bg-gray-50/70 transition">
                        <td class="py-4 px-6 text-center font-medium text-gray-400">{{ $index + 1 }}</td>
                        <td class="py-4 px-6 font-semibold text-gray-800">{{ $kasir->name }}</td>
                        <td class="py-4 px-6">{{ $kasir->email }}</td>
                        <td class="py-4 px-6">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-semibold uppercase">
                                {{ $kasir->role }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center flex items-center justify-center gap-2">
                            <a href="{{ route('admin.users.edit', $kasir->id) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.users.destroy', $kasir->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kasir ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-400">
                            <div class="text-4xl mb-3"><i class="fa-solid fa-folder-open"></i></div>
                            <p class="text-sm font-medium">Belum ada data kasir yang terdaftar.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection