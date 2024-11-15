<?php

namespace App\Http\Controllers;

use App\Models\AnggotaTani;
use App\Models\jadwalLahan;
use App\Models\KelompokTani as ModelsKelompokTani;
use App\Models\Lahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Menghitung total lahan milik user
        $totalLahan = Lahan::where('id_user', $user->id)->count();

        // Menghitung total anggota tani milik user
        $totalAnggota = AnggotaTani::where('id_user', $user->id)->count();

        // Menghitung total kelompok tani milik user
        $totalKelompok = ModelsKelompokTani::where('id_user', $user->id)->count();

        // Mendapatkan jadwal panen yang sedang aktif
        $jadwalPanenAktif = JadwalLahan::with('lahan')
            ->where('id_user', $user->id)
            ->where('status', 'Belum') // Filter berdasarkan status
            ->get();

        return view('dashboard', compact('totalLahan', 'totalAnggota', 'totalKelompok', 'jadwalPanenAktif'));
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Log out user dari sesi

        $request->session()->invalidate(); // Invalidate sesi pengguna
        $request->session()->regenerateToken(); // Regenerate token CSRF

        return redirect('/login')->with('success', 'Anda berhasil logout'); // Arahkan ke halaman login atau halaman lain
    }
}
