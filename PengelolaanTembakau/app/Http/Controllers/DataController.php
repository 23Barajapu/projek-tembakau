<?php

namespace App\Http\Controllers;

use App\Models\KelompokTani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function anggota()
    {
        return view('data_anggota_tani'); // Mengarah ke view dashboard
    }
    public function kelompok()
    {
        $user = Auth::user();
        $kelompokTani = KelompokTani::where('id_user', $user->id)->get();
        return view('data_kelompok_tani', compact('kelompokTani')); // Mengarah ke view dashboard
    }
    public function create()
    {
        return view('create_kelompok_tani');
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelompok' => 'required',
            'jenis_kelompok' => 'required',
            'jumlah_anggota' => 'required|integer',
            'ketua_kelompok' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'penyuluh' => 'required',
            'nip_penyuluh' => 'required',
        ]);

        KelompokTani::create([
            'nama_kelompok' => $request->nama_kelompok,
            'jenis_kelompok' => $request->jenis_kelompok,
            'jumlah_anggota' => $request->jumlah_anggota,
            'ketua_kelompok' => $request->ketua_kelompok,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'penyuluh' => $request->penyuluh,
            'nip_penyuluh' => $request->nip_penyuluh,
            'id_user' => Auth::user()->id, // Menambahkan id user saat data dibuat
        ]);
        return redirect()->route('kelompok')->with('success', 'Data berhasil ditambahkan');
    }

    // Form untuk mengedit data
    public function edit($id)
    {
        $kelompokTani = KelompokTani::findOrFail($id);
        return view('edit_kelompok_tani', compact('kelompokTani'));
    }

    // Update data di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelompok' => 'required',
            'jenis_kelompok' => 'required',
            'jumlah_anggota' => 'required|integer',
            'ketua_kelompok' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'penyuluh' => 'required',
            'nip_penyuluh' => 'required',
        ]);

        $kelompokTani = KelompokTani::findOrFail($id);
        $kelompokTani->update([
            'nama_kelompok' => $request->nama_kelompok,
            'jenis_kelompok' => $request->jenis_kelompok,
            'jumlah_anggota' => $request->jumlah_anggota,
            'ketua_kelompok' => $request->ketua_kelompok,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'penyuluh' => $request->penyuluh,
            'nip_penyuluh' => $request->nip_penyuluh,
            'id_user' => Auth::user()->id, // Mengubah id user saat data diupdate
        ]);

        return redirect()->route('kelompok')->with('success', 'Data berhasil diupdate');
    }

    // Menghapus data dari database
    public function destroy($id)
    {
        $kelompokTani = KelompokTani::findOrFail($id);
        $kelompokTani->delete();

        return redirect()->route('kelompok')->with('success', 'Data berhasil dihapus');
    }

}