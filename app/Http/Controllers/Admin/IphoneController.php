<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iphone;
use Illuminate\Http\Request;

class IphoneController extends Controller
{
    // 1. Menampilkan Semua Data iPhone
    public function index()
    {
        $iphones = Iphone::latest()->get();
        return view('admin.iphones.index', compact('iphones'));
    }

    // 2. Menampilkan Form Tambah
    public function create()
    {
        return view('admin.iphones.create');
    }

    // 3. Menyimpan Data iPhone Baru ke Database
    public function store(Request $request)
    {
        // KODE $request->with('iphone'); YANG BIKIN ERROR SUDAH DIBUANG!

        $request->validate([
            'tipe' => 'required|string|max:255',
            'kapasitas' => 'required|numeric',
            'warna' => 'required|string|max:50',
            'harga_per_hari' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses Upload Gambar Gadget
        $namaGambar = null;
        if ($request->hasFile('gambar')) {
            $namaGambar = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('uploads/iphones'), $namaGambar);
        }

        // Simpan ke database dengan mencocokkan nama kolom database (tipe_iphone & harga_perhari)
        Iphone::create([
            'tipe_iphone' => $request->tipe,
            'kapasitas' => $request->kapasitas,
            'warna' => $request->warna,
            'harga_perhari' => $request->harga_per_hari,
            'status' => 'Tersedia', // Set default awal unit baru
            'gambar' => $namaGambar,
        ]);

        return redirect()->route('admin.iphones.index')->with('success', 'Unit iPhone baru berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit
    public function edit($id)
    {
        $iphone = Iphone::findOrFail($id);
        return view('admin.iphones.edit', compact('iphone'));
    }

    // 5. Memproses Perubahan Data
    public function update(Request $request, $id)
    {
        $iphone = Iphone::findOrFail($id);

        $request->validate([
            'tipe' => 'required|string|max:255',
            'kapasitas' => 'required|numeric',
            'warna' => 'required|string|max:50',
            'harga_per_hari' => 'required|numeric|min:0',
            'status' => 'required|in:Tersedia,Disewa,Maintenance',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'tipe_iphone' => $request->tipe,
            'kapasitas' => $request->kapasitas,
            'warna' => $request->warna,
            'harga_perhari' => $request->harga_per_hari,
            'status' => $request->status,
        ];

        if ($request->hasFile('gambar')) {
            if ($iphone->gambar && file_exists(public_path('uploads/iphones/' . $iphone->gambar))) {
                unlink(public_path('uploads/iphones/' . $iphone->gambar));
            }

            $namaGambar = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move(public_path('uploads/iphones'), $namaGambar);
            $data['gambar'] = $namaGambar;
        }

        $iphone->update($data);

        return redirect()->route('admin.iphones.index')->with('info', 'Data iPhone berhasil diperbarui!');
    }

    // 6. Menghapus Data iPhone
    public function destroy($id)
    {
        $iphone = Iphone::findOrFail($id);

        if ($iphone->gambar && file_exists(public_path('uploads/iphones/' . $iphone->gambar))) {
            unlink(public_path('uploads/iphones/' . $iphone->gambar));
        }

        $iphone->delete();

        return redirect()->route('admin.iphones.index')->with('error', 'Data iPhone berhasil dihapus!');
    }

    // 7. Menampilkan Halaman Detail iPhone
    public function show($id)
    {
        $iphone = Iphone::findOrFail($id);
        return view('admin.iphones.show', compact('iphone'));
    }
}
