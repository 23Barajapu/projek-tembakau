<?php

namespace App\Http\Controllers;

use App\Models\GambarTahapan;
use App\Models\jadwalLahan;
use App\Models\Lahan;
use App\Models\Tahapan as ModelsTahapan;
use App\Models\User;
use App\Models\validation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tahapan;

class KirimPesanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function pesan($id)
    {
        $jadwal = jadwalLahan::findOrFail($id);
        $lahanData = jadwalLahan::with(['lahan'])->where('id', $id)->first();
        $tanggalTanam = $jadwal->tanggal_tanam;

        // Konversi tanggal tanam ke timestamp
        $tanggalTanamTimestamp = strtotime($tanggalTanam);
        if ($tanggalTanamTimestamp === false) {
            return redirect()->back()->withErrors(['Tanggal tanam tidak valid.']);
        }

        $currentDate = now();
        $tahapan = ModelsTahapan::all();
        $pesanArray = []; // Array untuk menyimpan semua pesan

        foreach ($tahapan as $item) {
            if (is_numeric($item->mulai) && is_numeric($item->selesai)) {
                // Menghitung tanggal mulai dan selesai
                $tanggalMulaiTimestamp = strtotime("+" . $item->mulai . " days", $tanggalTanamTimestamp);
                $tanggalSelesaiTimestamp = strtotime("+" . $item->selesai . " days", $tanggalTanamTimestamp);

                $item->startDate = Carbon::parse(date('Y-m-d', $tanggalMulaiTimestamp));
                $item->endDate = Carbon::parse(date('Y-m-d', $tanggalSelesaiTimestamp));
                $item->daysSinceStart = (int) $item->startDate->diffInDays($currentDate) + 1;

                $item->tahapDetail = ModelsTahapan::where('mulai', '<=', $item->daysSinceStart)
                    ->where('selesai', '>=', $item->daysSinceStart)
                    ->first(); // Mencari tahap yang sesuai

                $validasi = validation::where('jadwal_id', $lahanData->id)
                    ->where('tahapan_id', $item->id)
                    ->where('hari', $item->daysSinceStart)
                    ->first();
                if ($item->tahapDetail) {
                    // Jika ditemukan, Anda bisa mengakses $tahap->id
                    $validasi = validation::where('jadwal_id', $lahanData->id)
                        ->where('tahapan_id', $item->tahapDetail->id)
                        ->where('hari', $item->daysSinceStart)
                        ->first();
                    $tahapBerikutnya = $item->tahapDetail->tahap + 1;
                    $item->tahapBerikutnya = ModelsTahapan::where('tahap', $tahapBerikutnya)->first();
                } else {
                    // Jika $tahap adalah null, berikan penanganan atau pesan error
                    $validasi = null;
                    $item->tahapBerikutnya = null;
                }

                $item->val = $validasi ? true : false;
                $isOngoing = $currentDate->between($item->startDate, $item->endDate);

                $daysUntilEnd = $currentDate->diffInDays($item->endDate) + 1;
                $RentangTahap = [10, 3, 1];

                if ($isOngoing) {
                    if (in_array($daysUntilEnd, $RentangTahap) && $item->tahapBerikutnya) {
                        $pesanArray[] = "
                            Peringatan Tahapan! Tahapan selanjutnya akan segera dilakukan dalam $daysUntilEnd hari lagi.
                            Segera siapkan dirimu.
                        ";
                    }

                    if ($item->daysSinceStart == 1 && !$validasi) {
                        $pesanArray[] = "
                            Hari pertama dalam tahap ini. Silakan lakukan validasi sudah menyelesaikan tahapan dengan mengupload foto.
                        ";
                    }

                    if ($item->daysSinceStart != 1 && !$item->val) {
                        $pesanArray[] = "
                            Penyelesaian Tahapan! Segera lakukan penyelesaian tahapan dan harap lakukan validasi sudah menyelesaikan tahapan hari ini.
                        ";
                    }
                }
            } else {
                return redirect()->back()->withErrors(['Data tahapan tidak valid.']);
            }
        }

        $totalDays = ModelsTahapan::orderBy('selesai', 'desc')->first()->selesai ?? 0;
        $notificationDays = [];
        for ($i = 3; $i <= $totalDays; $i += 3) {
            $notificationDays[] = Carbon::parse($tanggalTanam)->addDays($i)->format('Y-m-d');
        }

        $lastNotificationDate = session('last_notification_date', null);

        if (in_array($currentDate->format('Y-m-d'), $notificationDays) && $currentDate->format('Y-m-d') !== $lastNotificationDate) {
            $pesanArray[] = "
                Pengawasan Hama, Virus, dan Ulat! Lakukan pemeriksaan berkala pada Lahan Tembakau. Agar terhindar dari Hama, Virus, dan Ulat.
            ";
        }
        $pesanArray[] = "
        Pengawasan test
    ";

        // Menggabungkan semua pesan menjadi satu string
        $pesan = implode("<br>", $pesanArray);
        return $pesan;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Periksa apakah user ada
        if ($user) {
            // Dapatkan pesan berdasarkan user ID atau sesuai logika yang diinginkan
            $pesan = $this->pesan($user->id); // Ganti dengan cara mengambil pesan yang tepat

            // Kirim notifikasi ke semua pengguna
            User::all()->each(function ($user) use ($pesan) {
                $user->notify(new \App\Notifications\KirimPesanMassalNotification($pesan));
            });
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}