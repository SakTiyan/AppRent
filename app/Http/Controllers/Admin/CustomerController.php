<?php

namespace App\Http\Controllers\Admin; // Namespace diperbarui ke sub-folder Admin

use App\Http\Controllers\Controller; // Wajib import Controller utama
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // 1. Tampilkan Halaman Index Pelanggan
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('admin.customers.index', compact('customers'));
    }

    // 2. Tampilkan Form Tambah Pelanggan
    public function create()
    {
        return view('admin.customers.create');
    }

    // 3. Simpan Data Pelanggan Baru
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:16|unique:customers,nik',
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        Customer::create($request->all());

        return redirect()->route('admin.customers.index')->with('success', 'Data Customer berhasil ditambahkan!');
    }

    // 4. Tampilkan Form Edit Pelanggan
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    // 5. Simpan Perubahan Data Pelanggan
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'nik' => 'required|string|max:16|unique:customers,nik,' . $customer->id,
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
        ]);

        $customer->update($request->all());

        return redirect()->route('admin.customers.index')->with('info', 'Data Customer berhasil diperbarui!');
    }

    // 6. Hapus Data Pelanggan
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('error', 'Data Customer berhasil dihapus!');
    }
}
