<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangPanen;
use App\Models\Kategori;

class BarangPanenController extends Controller
{
    public function index(Request $request)
    {
        // Panggil metode getData untuk mengambil data kategori dan barang
        $data = $this->getData();

        // Lakukan sorting dan filtering jika diperlukan
        $sortBy = $request->input('sort_by', 'id_brg');
        $sortDirection = $request->input('sort_direction', 'asc');
        $categoryId = $request->input('category_id');

        // Filter barang berdasarkan kategori yang dipilih
        $query = BarangPanen::with('kategori')->orderBy($sortBy, $sortDirection);
        if ($categoryId) {
            $query->where('kategori_id', $categoryId);
        }

        // Timpa data 'barang' dengan hasil filter
        $data['barang'] = $query->get();

        // Kirim data ke view
        return view('BackEnd.barang_panen', $data);
    }

    public function getData()
    {
        $categories = Kategori::all(); // Ambil semua kategori
        $barang = BarangPanen::all(); // Ambil semua barang panen

        // Mengembalikan data sebagai array
        return compact('categories', 'barang');
    }

    public function show($id)
    {
        $barang = BarangPanen::findOrFail($id);
        return view('barang_panen.show', compact('barang'));
    }

    public function filter(Request $request)
    {
        $categoryId = $request->input('category_id');

        // Memeriksa apakah category_id tidak kosong
        if ($categoryId) {
            $barang = BarangPanen::where('kategori_id', $categoryId)->get();
        } else {
            $barang = BarangPanen::all();
        }

        $categories = Kategori::all();

        return view('BackEnd.barang_panen', compact('barang', 'categories'));
    }



    public function create()
    {
        $kategori = Kategori::all();

        // Generate ID barang otomatis
        $lastItem = BarangPanen::orderBy('id_brg', 'desc')->first();

        if ($lastItem) {
            // Ambil angka dari ID terakhir
            $lastIdNumber = intval(substr($lastItem->id_brg, 3));
            $newIdNumber = $lastIdNumber + 1;
        } else {
            // Jika belum ada barang, mulai dari 1
            $newIdNumber = 1;
        }

        // Format ID barang baru: 'BRG' + nomor 3 digit (misal 'BRG001')
        $newIdBarang = 'BRG' . str_pad($newIdNumber, 3, '0', STR_PAD_LEFT);

        // Kirimkan kategori dan newIdBarang ke view
        return view('BackEnd.barang_panen.create', compact('kategori', 'newIdBarang'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'satuan' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar_brg' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        // Gunakan ID barang yang telah di-generate saat create
        $newIdBarang = $request->id_brg;

        // Mengunggah gambar
        if ($request->hasFile('gambar_brg')) {
            $imageName = time() . '.' . $request->gambar_brg->extension();
            $request->gambar_brg->move(public_path('images'), $imageName);
        }

        // Simpan data ke database
        BarangPanen::create([
            'id_brg' => $newIdBarang,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar_brg' => $imageName,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('barang_panen.index')->with('success', 'Data berhasil disimpan');
    }


    public function edit($id_brg)
    {
        $barang_panen = BarangPanen::findOrFail($id_brg);
        $kategori = Kategori::all();
        return view('BackEnd.barang_panen.edit', compact('barang_panen', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_brg' => 'required|string|max:20|exists:barang_panen,id_brg',
            'nama' => 'required|string|max:100',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'satuan' => 'required|in:Kg,Ton',
            'deskripsi' => 'required|string',
            'gambar_brg' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        $barang_panen = BarangPanen::findOrFail($id);

        if ($request->hasFile('gambar_brg')) {
            // Hapus gambar lama jika ada
            if ($barang_panen->gambar_brg && file_exists(public_path('images/' . $barang_panen->gambar_brg))) {
                unlink(public_path('images/' . $barang_panen->gambar_brg));
            }

            // Upload gambar baru
            $gambar = $request->file('gambar_brg');
            $gambarName = time() . '.' . $gambar->getClientOriginalExtension();
            $gambarPath = 'images/' . $gambarName;
            $gambar->move(public_path('images'), $gambarName);
        } else {
            $gambarPath = $barang_panen->gambar_brg;
        }

        $barang_panen->update([
            'id_brg' => $request->id_brg,
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'gambar_brg' => $gambarPath,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('barang_panen.index')->with('success', 'Barang Panen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang_panen = BarangPanen::findOrFail($id);

        // Hapus gambar dari storage
        if ($barang_panen->gambar_brg && file_exists(public_path($barang_panen->gambar_brg))) {
            unlink(public_path($barang_panen->gambar_brg));
        }

        $barang_panen->delete();

        return redirect()->route('barang_panen.index')->with('success', 'Barang Panen berhasil dihapus.');
    }
}
