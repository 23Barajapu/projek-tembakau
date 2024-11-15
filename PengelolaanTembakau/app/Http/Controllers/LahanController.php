<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lahan;
use App\Models\AnggotaTani;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LahanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $lahan = Lahan::with('AnggotaTani')->where('id_user', $user->id)->get();
        return view('data_lahan', compact('lahan'));
    }
    // Tampilkan form untuk membuat lahan baru
    public function create()
    {
        $user = Auth::user();
        $anggota = AnggotaTani::where('id_user', $user->id)->get(); // Mendapatkan data anggota tani
        return view('create_lahan', compact('anggota'));
    }

    // Simpan data lahan ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pengurus_lahan' => 'required|exists:anggota_tanis,id',
            'namaLahan' => 'required|string|max:255',
            'luas_lahan' => 'required|numeric|min:1',
            'alamat_lahan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'pbb' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'foto_lahan' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'sertif_lahan' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // Debugging: Periksa data request
        //dd($request->all());
        // Simpan file foto lahan dan sertifikat lahan
        if ($request->hasFile('foto_lahan')) {
            $imageLahan = time() . $request->foto_lahan->getClientOriginalName();
            // Buat direktori jika belum ada
            $request->foto_lahan->move(public_path('lahan'), $imageLahan);
        }

        if ($request->hasFile('pbb')) {
            $imagePbb = time() . $request->pbb->getClientOriginalName();
            // Buat direktori jika belum ada
            $request->pbb->move(public_path('pbb'), $imagePbb);
        }

        if ($request->hasFile('sertif_lahan')) {
            $imageSertif = time() . $request->sertif_lahan->getClientOriginalName();
            $request->sertif_lahan->move(public_path('sertif'), $imageSertif);
        }
        $user = Auth::user();
        // Simpan data lahan
        Lahan::create([
            'pengurus_lahan' => $request->pengurus_lahan,
            'nama_lahan' => $request->namaLahan,
            'luas_lahan' => $request->luas_lahan,
            'alamat_lahan' => $request->alamat_lahan,
            'status' => $request->status,
            'pbb' => $imagePbb,
            'foto_lahan' => $imageLahan, // Simpan path lengkap
            'sertifikat_lahan' => $imageSertif, // Simpan path lengkap
            'id_user' => $user->id, // Ambil user yang sedang login
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('lahan.index')->with('success', 'Data lahan berhasil ditambahkan!');
    }


    // Tampilkan form untuk mengedit data lahan
    public function edit($id)
    {
        $user = Auth::user();
        $lahan = Lahan::findOrFail($id); // Temukan data lahan berdasarkan ID
        $anggota = AnggotaTani::where('id_user', $user->id)->get(); // Mendapatkan data anggota tani
        return view('edit_lahan', compact('lahan', 'anggota'));
    }

    // Update data lahan di database
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'pengurus_lahan' => 'required|exists:anggota_tanis,id',
            'namaLahan' => 'required|string|max:255',
            'luas_lahan' => 'required|numeric|min:1',
            'alamat_lahan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'pbb' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'foto_lahan' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'sertif_lahan' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $lahan = Lahan::findOrFail($id);

        // Hanya hapus dan simpan file baru jika di-upload
        if ($request->hasFile('foto_lahan')) {
            // Save foto
            $filePath = public_path('lahan');
            $file = $request->file('foto_lahan');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($filePath, $file_name);

            // delete gambar
            if (!is_null($lahan->foto_lahan)) {
                $oldImage = public_path('lahan/' . $lahan->foto_lahan);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $lahan->foto_lahan = $file_name;
        }


        if ($request->hasFile('sertif_lahan')) {
            // Save foto
            $filePath = public_path('sertif');
            $file = $request->file('sertif_lahan');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($filePath, $file_name);

            // delete gambar
            if (!is_null($lahan->sertifikat_lahan)) {
                $oldImage = public_path('sertif/' . $lahan->sertifikat_lahan);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $lahan->sertifikat_lahan = $file_name;
        }

        if ($request->hasFile('pbb')) {
            // Save foto
            $filePath = public_path('pbb');
            $file = $request->file('pbb');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($filePath, $file_name);

            // delete gambar
            if (!is_null($lahan->pbb)) {
                $oldImage = public_path('pbb/' . $lahan->pbb);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $lahan->pbb = $file_name;
        }



        // Update data lahan
        $lahan->update([
            'pengurus_lahan' => $request->pengurus_lahan,
            'nama_lahan' => $request->namaLahan,
            'luas_lahan' => $request->luas_lahan,
            'alamat_lahan' => $request->alamat_lahan,
            'status' => $request->status,
            'pbb' => $lahan->pbb,
            'foto_lahan' => $lahan->foto_lahan,
            'sertifikat_lahan' => $lahan->sertifikat_lahan,
        ]);

        return redirect()->route('lahan.index')->with('success', 'Data lahan berhasil diperbarui!');
    }


    // Hapus data lahan dari database
    public function destroy($id)
    {
        $lahan = Lahan::findOrFail($id);

        // Hapus file foto lahan jika ada
        if (!empty($lahan->foto_lahan) && Storage::disk('public')->exists($lahan->foto_lahan)) {
            Storage::disk('public')->delete($lahan->foto_lahan);
        }

        // Hapus file sertifikat lahan jika ada
        if (!empty($lahan->sertif_lahan) && Storage::disk('public')->exists($lahan->sertif_lahan)) {
            Storage::disk('public')->delete($lahan->sertif_lahan);
        }

        // Hapus data lahan dari database
        $lahan->delete();

        return redirect()->route('lahan.index')->with('success', 'Data lahan berhasil dihapus!');
    }

}