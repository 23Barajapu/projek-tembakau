<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GambarTahapan;
use App\Models\jadwalLahan;
use App\Models\Lahan;
use App\Models\Tahapan;
use App\Models\validation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;


class TahapanController extends Controller
{

    public function index($id)
    {
        $jadwal = jadwalLahan::findOrFail($id);
        $lahanData = jadwalLahan::with(['lahan'])
            ->where('id', $id) // Mengambil data berdasarkan ID
            ->first(); // Mengambil satu data (gunakan get() jika ingin hasil berupa koleksi)
        $lahan = Lahan::with(['AnggotaTani'])
            ->where('id', $lahanData->lahan->id) // Filter berdasarkan
            ->first(); // Mengambil satu data lahan dengan relasi jadwalLahan


        $tanggalTanam = $jadwal->tanggal_tanam; // Ubah ke format yang lebih umum
        $tahapan = Tahapan::where('id_user', Auth::id())->get();

        // Mengonversi tanggal tanam ke timestamp
        $tanggalTanamTimestamp = strtotime($tanggalTanam);

        $currentDate = now();
        if ($tanggalTanamTimestamp === false) {
            // Tangani kesalahan jika tanggal tidak dapat diubah menjadi timestamp
            return redirect()->back()->withErrors(['Tanggal tanam tidak valid.']);
        }

        foreach ($tahapan as $item) {
            // Pastikan nilai mulai dan selesai valid
            if (is_numeric($item->mulai) && is_numeric($item->selesai)) {
                // Menghitung tanggal mulai dan selesai
                $tanggalMulaiTimestamp = strtotime("+" . ($item->mulai) . " days", $tanggalTanamTimestamp);
                $tanggalSelesaiTimestamp = strtotime("+" . ($item->selesai) . " days", $tanggalTanamTimestamp);

                // Mengonversi kembali ke format tanggal
                $item->tanggal_mulai = date('d F Y', $tanggalMulaiTimestamp);
                $item->tanggal_selesai = date('d F Y', $tanggalSelesaiTimestamp);
                $gambar = GambarTahapan::where('jadwal_id', $lahanData->id)
                    ->where('tahapan_id', $item->id)
                    ->first();

                if ($gambar) {
                    // Data gambar ditemukan, lakukan sesuatu
                    $gambarHasil = $gambar; // misalnya mengakses properti url
                } else {
                    // Data gambar tidak ditemukan, bisa berikan nilai default atau tindakan lain
                    $gambarHasil = ''; // contoh nilai default
                }
                $item->startDate = Carbon::parse($item->tanggal_mulai);
                $item->endDate = Carbon::parse($item->tanggal_selesai);
                $item->daysSinceStart1 = floor($item->startDate->diffInDays($currentDate) + 1);
                $item->daysSinceStart = (int) floor($item->daysSinceStart1); // Pastikan menjadi integer

                $item->tahapDetail = Tahapan::where('mulai', '<=', $item->daysSinceStart)
                    ->where('selesai', '>=', $item->daysSinceStart)
                    ->first(); // Mencari tahap yang sesuai


                if ($item->tahapDetail) {
                    // Jika ditemukan, Anda bisa mengakses $tahap->id
                    $validasi = validation::where('jadwal_id', $lahanData->id)
                        ->where('tahapan_id', $item->tahapDetail->id)
                        ->where('hari', $item->daysSinceStart)
                        ->first();
                    $tahapBerikutnya = $item->tahapDetail->tahap + 1;
                    $item->tahapBerikutnya = Tahapan::where('tahap', $tahapBerikutnya)->first();
                } else {
                    // Jika $tahap adalah null, berikan penanganan atau pesan error
                    $validasi = null;
                    $item->tahapBerikutnya = null;
                }

                // Cek apakah validasi ditemukan
                $item->validasi = $validasi;
                $isValidasiExists = !is_null($validasi); // true jika ada, false jika tidak ada


                // Set nilai validasi
                if ($isValidasiExists) {
                    $item->val = true; // Ada validasi untuk hari yang sama
                } else {
                    $item->val = false; // Tidak ada validasi untuk hari yang sama
                }
            } else {
                // Tangani kesalahan jika mulai atau selesai tidak valid
                return redirect()->back()->withErrors(['Data tahapan tidak valid.']);
            }
        }
        return view('detail_monitoring', [
            'tahapan' => $tahapan,
            'tahap' => $tahapan,
            'lahanData' => $lahanData,
            'lahan' => $lahan,
            'gambar' => $gambarHasil,
            'jadwal' => $jadwal,
        ]);
    }


    public function validasiTahap(Request $request, $id_tahap, $id_jadwal)
    {

        // Simpan data validasi harian ke tabel gambar_tahapan atau model yang sesuai
        $validasi = Validation::create([
            'tahapan_id' => $id_tahap,
            'jadwal_id' => $id_jadwal,
            'hari' => Request::input('hari'),
            'tanggal_terakhir_unggah' => today(),
        ]);

        // Mendapatkan tahap terakhir dari user berdasarkan user_id
        $tahapTerakhir = Tahapan::where('user_id', Auth::id())
            ->orderBy('tahap', 'desc')
            ->first();



        // Memastikan tahap terakhir ada, dan bandingkan kolom selesai dengan hari validasi
        if ($tahapTerakhir && $tahapTerakhir->selesai == Request::input('hari')) {
            // Update status jadwalLahan menjadi 'Selesai'
            $jadwalLahan = JadwalLahan::findOrFail($id_jadwal);
            $jadwalLahan->update(['status' => 'Selesai']);
        }

        return redirect()->back()->with('success', 'Berhasil validasi tahap hari ini!');
    }

    public function validasiGambar($id_tahap, $id_jadwal)
    {
        // Validasi input gambar
        $validatedData = Request::validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Simpan gambar ke storage
        if (Request::hasFile('gambar')) {
            $file = Request::file('gambar');
            $filePath = $file->store('gambar_tahaps', 'public');

            // Simpan informasi gambar ke tabel gambar_tahaps
            GambarTahapan::create([
                'tahapan_id' => $id_tahap,
                'jadwal_id' => $id_jadwal,
                'nama' => $filePath,
                'status' => 'Selesai',
                'validasi' => 1,
                'tanggal_terakhir_unggah' => today(),
            ]);

            return redirect()->back()->with('success', 'Gambar berhasil diunggah!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah gambar!');
    }
}
