<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tahapan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TahapanController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $tahapan = Tahapan::orderBy('tahap')->where('id_user', $user->id)->get();
        return view('Tahapan.tahapan', compact('tahapan'));
    }

    public function create()
    {
        return view('Tahapan.create_tahapan');  // Pisahkan view create
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahap' => [
                'required',
                'integer',
                Rule::unique('tahapan', 'tahap')->where(function ($query) {
                    return $query->where('id_user', Auth::id());
                }),
            ],
            'nama_tahap' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'mulai' => 'required|integer',
            'selesai' => 'required|integer',
        ]);
        Tahapan::create([
            'id_user' => Auth::user()->id,
            'tahap' => $request->tahap,
            'nama_tahap' => $request->nama_tahap,
            'deskripsi' => $request->deskripsi,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
        ]);

        return redirect()->route('tahapan.show')->with('success', 'Tahapan berhasil ditambahkan');
    }

    public function edit(Tahapan $tahap)
    {
        return view('Tahapan.edit_tahapan', compact('tahap'));
    }

    public function update(Request $request, Tahapan $tahap)
    {
        // Validasi data yang akan di-update
        $request->validate([
            'tahap' => [
                'required',
                'integer',
                Rule::unique('tahapan', 'tahap')
                    ->where(function ($query) {
                        return $query->where('id_user', Auth::id());
                    })
                    ->ignore($tahap->id), // Abaikan tahap yang sedang di-update
            ],
            'nama_tahap' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'mulai' => 'required|integer',
            'selesai' => 'required|integer',
        ]);

        // Update hanya kolom yang tervalidasi
        $tahap->update([
            'tahap' => $request->input('tahap'),
            'nama_tahap' => $request->input('nama_tahap'),
            'deskripsi' => $request->input('deskripsi'),
            'mulai' => $request->input('mulai'),
            'selesai' => $request->input('selesai'),
        ]);

        return redirect()->route('tahapan.show')->with('success', 'Tahapan berhasil diperbarui');
    }

    public function destroy(Tahapan $tahap)
    {
        $tahap->delete();

        return redirect()->route('tahapan.show')->with('success', 'Tahapan berhasil dihapus');
    }


}