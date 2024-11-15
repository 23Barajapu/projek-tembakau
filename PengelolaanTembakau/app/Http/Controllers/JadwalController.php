<?php

namespace App\Http\Controllers;

use App\Models\jadwalLahan;
use App\Models\Lahan;
use App\Models\Tahapan as ModelsTahapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua data jadwal beserta relasi lahan dan tahapan
        $tahapan = ModelsTahapan::where('id_user', $user->id)->orderBy('tahap')->get();

        $jadwals = jadwalLahan::where('id_user', $user->id)->where('status', 'Belum')->with('lahan')->get();
        // Kirim data ke view
        return view('data_jadwal', compact('jadwals', 'tahapan'));
    }
    public function monitoring()
    {
        $user = Auth::user();
        $lahanData = jadwalLahan::where('id_user', $user->id)->where('status', 'Belum')->with(['lahan'])->get(); // Mengambil data lahan beserta jadwal dan tahapan
        $tahapan = ModelsTahapan::where('id_user', $user->id)->orderBy('tahap')->get();
        // Mengambil data lahan beserta jadwal dan tahapan

        return view('monitoring', compact('lahanData', 'tahapan'));
    }
    public function detail()
    {
        $user = Auth::user();
        $lahanData = jadwalLahan::where('id_user', $user->id)->with(['lahan'])->get(); // Mengambil data lahan beserta jadwal dan tahapan
        $tahapan = ModelsTahapan::where('id_user', $user->id)->orderBy('tahap')->get();
        // Mengambil data lahan beserta jadwal dan tahapan

        return view('detail_monitoring', compact('lahanData', 'tahapan'));
    }

    public function create()
    {
        $user = Auth::user();
        $lahan = Lahan::where('id_user', $user->id)->get();
        return view('create_jadwal_lahan', compact('lahan'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'lahan_id' => 'required|integer|max:255',
            'tanggal_tanam' => 'required|date',
            'pupuk' => 'required',
            'bibit' => 'required',
        ]);

        jadwalLahan::create([
            'lahan_id' => $request->lahan_id,
            'tanggal_tanam' => $request->tanggal_tanam,
            'pupuk' => $request->pupuk,
            'bibit' => $request->bibit,
            'id_user' => $user->id, // Menambahkan id user saat jadwal dibuat
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Lahan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $jadwal = jadwalLahan::findOrFail($id);
        $lahan = Lahan::where('id_user', $user->id)->get(); // Ambil semua lahan untuk pilihan lahan
        return view('edit_jadwal', compact('jadwal', 'lahan'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'lahan_id' => 'required|integer',
            'tanggal_tanam' => 'nullable',
            'pupuk' => 'required',
            'bibit' => 'required',
        ]);

        $jadwal = jadwalLahan::findOrFail($id);
        $jadwal->update([
            'lahan_id' => $request->lahan_id,
            'tanggal_tanam' => $request->tanggal_tanam,
            'pupuk' => $request->pupuk,
            'bibit' => $request->bibit,
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diupdate.');
    }


    public function destroy($id)
    {
        $jadwal = jadwalLahan::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }


    public function getLahanSize($id)
    {
        $lahan = Lahan::find($id); // Ambil data lahan berdasarkan ID

        if ($lahan) {
            return response()->json(['size' => $lahan->luas_lahan]); // Misalnya ukuran disimpan di kolom 'ukuran'
        }

        return response()->json(['error' => 'Lahan not found'], 404);
    }
    public function showJadwal()
    {
        $user = Auth::user();
        // Ambil semua data jadwal beserta relasi lahan dan tahapan
        $jadwals = jadwalLahan::with('lahan', 'tahapan')->where('id_user', $user->id)->get();

        // Kirim data ke view
        return view('jadwal.index', compact('jadwals'));
    }
}
