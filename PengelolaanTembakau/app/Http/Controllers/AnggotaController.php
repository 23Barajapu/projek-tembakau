<?php
namespace App\Http\Controllers;

use App\Models\AnggotaTani;
use App\Models\KelompokTani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $anggota = AnggotaTani::with('kelompokTani')
            ->where('id_user', $user->id)
            ->get();
        return view('data_anggota_tani', compact('anggota'));
    }

    public function create()
    {
        $user = Auth::user();
        $kelompokTani = KelompokTani::where('id_user', $user->id)->get();
        return view('create_anggota_tani', compact('kelompokTani'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'kelompok_tani_id' => 'required|exists:kelompok_tani,id',
            'nama_anggota' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|numeric', // Optional: use 'string' if you expect non-numeric chars
            'ktp_path' => 'required|mimes:jpg,jpeg,png|max:3048', // max 3MB
            'kk' => 'required|mimes:jpg,jpeg,png|max:3048', // max 3MB
            'buku_nikah' => 'required|mimes:jpg,jpeg,png|max:3048', // max 3MB
        ]);

        // Debugging: Lihat data yang dikirim
        //dd($request->all());

        // Upload file with unique name
        if ($request->hasFile('ktp_path')) {
            $imageName = time() . $request->ktp_path->getClientOriginalName();
            // Buat direktori jika belum ada
            $request->ktp_path->move(public_path('ktp'), $imageName);
        }
        if ($request->hasFile('kk')) {
            $imageKK = time() . $request->kk->getClientOriginalName();
            // Buat direktori jika belum ada
            $request->kk->move(public_path('kk'), $imageKK);
        }
        if ($request->hasFile('buku_nikah')) {
            $imageBK = time() . $request->buku_nikah->getClientOriginalName();
            // Buat direktori jika belum ada
            $request->buku_nikah->move(public_path('buku_nikah'), $imageBK);
        }
        $user = Auth::user();
        // Simpan data ke database
        AnggotaTani::create([
            'kelompok_tani_id' => $request->kelompok_tani_id,
            'nama_anggota' => $request->nama_anggota,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'ktp_path' => $imageName,
            'kk' => $imageKK,
            'buku_nikah' => $imageBK,
            'id_user' => $user->id,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $user = Auth::user();
        $anggota = AnggotaTani::findOrFail($id);
        $kelompokTani = KelompokTani::where('id_user', $user->id)->get();
        return view('edit_anggota_tani', compact('anggota', 'kelompokTani'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kelompok_tani_id' => 'required',
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'telepon' => 'required|numeric',  // Mengubah validasi nomor telepon
            'ktp_path' => 'nullable|file|mimes:jpg,jpeg,png|max:3048',
            'kk' => 'nullable|file|mimes:jpg,jpeg,png|max:3048',
            'buku_nikah' => 'nullable|file|mimes:jpg,jpeg,png|max:3048'
        ]);

        $anggota = AnggotaTani::findOrFail($id);

        // Penanganan file upload, cek dan hapus gambar lama jika ada
        if ($request->hasFile('ktp_path')) {
            // Save foto
            $filePath = public_path('ktp');
            $file = $request->file('ktp_path');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($filePath, $file_name);

            // delete gambar baru
            if (!is_null($anggota->ktp_path)) {
                $oldImage = public_path('ktp/' . $anggota->ktp_path);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $anggota->ktp_path = $file_name;
        }

        // Penanganan file upload, cek dan hapus gambar lama jika ada
        if ($request->hasFile('kk')) {
            // Save foto
            $filePath = public_path('kk');
            $file = $request->file('kk');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($filePath, $file_name);

            // delete gambar baru
            if (!is_null($anggota->kk)) {
                $oldImage = public_path('kk/' . $anggota->kk);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $anggota->kk = $file_name;
        }

        // Penanganan file upload, cek dan hapus gambar lama jika ada
        if ($request->hasFile('buku_nikah')) {
            // Save foto
            $filePath = public_path('buku_nikah');
            $file = $request->file('buku_nikah');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($filePath, $file_name);

            // delete gambar baru
            if (!is_null($anggota->buku_nikah)) {
                $oldImage = public_path('buku_nikah/' . $anggota->buku_nikah);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $anggota->buku_nikah = $file_name;
        }

        // Update data anggota
        $anggota->update([
            'kelompok_tani_id' => $request->kelompok_tani_id,
            'nama_anggota' => $request->nama_anggota,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'ktp_path' => $anggota->ktp_path,
            'kk' => $anggota->kk,
            'buku_nikah' => $anggota->buku_nikah,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }



    public function destroy($id)
    {
        $anggota = AnggotaTani::findOrFail($id);

        // Delete files if they exist
        if ($anggota->ktp_path) {
            Storage::delete($anggota->ktp_path);
        }
        if ($anggota->kk) {
            Storage::delete($anggota->kk);
        }
        if ($anggota->buku_nikah) {
            Storage::delete($anggota->buku_nikah);
        }

        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }
}