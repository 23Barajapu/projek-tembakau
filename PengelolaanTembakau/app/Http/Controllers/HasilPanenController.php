<?php

namespace App\Http\Controllers;

use App\Models\jadwalLahan;
use App\Models\Panen;
use Illuminate\Http\Request;
use App\Models\HasilPanen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HasilPanenController extends Controller
{
    // Menampilkan halaman utama hasil panen
    public function index()
{
    $user = Auth::user();

    // Ambil data hasil panen yang sesuai dengan pengguna saat ini
    $hasilPanen = Panen::with('lahan')
        ->where('id_user', $user->id) // Jika terdapat hubungan user dengan data panen
        ->get();

    return view('data_hasil_panen', compact('hasilPanen'));
}

    // Mendapatkan pengurus Lahan berdasarkan nama Lahan
    public function getPengurusByLahan(Request $request)
    {
        $namaLahan = $request->input('namaLahan');

        // Query untuk mengambil "pengurus_lahan" berdasarkan "nama_lahan"
        $lahan = db::table('lahan')->where('nama_lahan', $namaLahan)->first();

    // Mengembalikan response dengan "pengurus_lahan" jika ditemukan, jika tidak, kembalikan null
        return response()->json([
            'pengurus' => $lahan ? $lahan->pengurus_lahan : null,
        ]);
    }

    // Menyimpan data hasil panen
    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'namaLahan' => 'required|string',
        'tanggalPenanaman' => 'required|date',
        'tanggalPanen' => 'required|date',
        'jumlahPanen' => 'required|numeric',
        'hargaGradeA' => 'required|numeric|min:100000|max:130000',
        'hargaGradeB' => 'required|numeric|min:80000|max:100000',
        'hargaGradeC' => 'required|numeric|min:60000|max:80000',
    ]);

    // Simpan data ke dalam database
    try {
        HasilPanen::create([
            'namaLahan' => $request->namaLahan,
            'tanggalPenanaman' => $request->tanggalPenanaman,
            'tanggalPanen' => $request->tanggalPanen,
            'jumlahPanen' => $request->jumlahPanen,
            'hargaGradeA' => $request->hargaGradeA,
            'hargaGradeB' => $request->hargaGradeB,
            'hargaGradeC' => $request->hargaGradeC,
            'id_user' => Auth::id(), // Menambahkan ID pengguna yang sedang login
        ]);
        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Gagal menambahkan data panen', 'error' => $e->getMessage()], 500);
    }
}

    // Melakukan prediksi hasil panen berdasarkan data yang diberikan
    public function prediksi(Request $request)
    {
        $jumlahPanen = $request->input('jumlahPanen');
        $hargaGradeA = $request->input('hargaGradeA');
        $hargaGradeB = $request->input('hargaGradeB');
        $hargaGradeC = $request->input('hargaGradeC');

        $pendapatanGradeA = $jumlahPanen * $hargaGradeA;
        $pendapatanGradeB = $jumlahPanen * $hargaGradeB;
        $pendapatanGradeC = $jumlahPanen * $hargaGradeC;

        return response()->json([
            'pendapatanGradeA' => $pendapatanGradeA,
            'pendapatanGradeB' => $pendapatanGradeB,
            'pendapatanGradeC' => $pendapatanGradeC,
        ]);
    }
}
