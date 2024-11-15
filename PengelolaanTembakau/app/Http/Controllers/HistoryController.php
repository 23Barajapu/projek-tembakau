<?php

namespace App\Http\Controllers;

use App\Models\GambarTahapan;
use App\Models\jadwalLahan;
use App\Models\Lahan;
use App\Models\validation;
use Illuminate\Http\Request;
use Tahapan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function semua(Request $request, $jadwal_id)
    {
        // Ambil tahun dan bulan dari request, atau gunakan tahun dan bulan sekarang jika tidak ada
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);

        // Pastikan nilai tahun dan bulan valid
        $date = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $date->daysInMonth;

        $monthData = [
            'name' => $date->format('F'),
            'year' => $date->year,
            'days' => [],
        ];

        // Loop untuk setiap hari dalam bulan ini
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dayDate = Carbon::createFromDate($year, $month, $day);
            $monthData['days'][] = [
                'day' => $day,
                'dayOfWeek' => $dayDate->format('l'),
            ];
        }

        // Hitung bulan dan tahun berikutnya
        $nextMonth = $date->copy()->addMonth();
        $prevMonth = $date->copy()->subMonth();

        // Ambil data kalender dengan ikon validasi dan gambar
        $kalender = $this->getJadwalWithIcons($jadwal_id, $month, $year);
        $user = Auth::user();

        // Ambil informasi jadwal lengkap dengan data terkait
        $jadwal = jadwalLahan::with(['gambarTahaps', 'validations', 'lahan'])
            ->where('id', $jadwal_id)
            ->where('id_user', $user->id)
            ->where('status', 'Selesai')
            ->whereMonth('tanggal_tanam', $month)
            ->whereYear('tanggal_tanam', $year)
            ->firstOrFail();

        // Return view with combined data
        return view('history_jadwal', [
            'monthData' => $monthData,
            'nextMonth' => $nextMonth,
            'prevMonth' => $prevMonth,
            'kalender' => $kalender,  // Add calendar data with icons
            'jadwal' => $jadwal,      // Add detailed jadwal data
            'bulan' => $month,
            'tahun' => $year,
        ]);
    }

    public function getJadwalWithIcons($jadwal_id, $bulan, $tahun)
    {
        $user = Auth::user();

        // Get the specified schedule with its validations and image submissions
        $jadwal = jadwalLahan::with(['gambarTahaps', 'validations'])
            ->where('id', $jadwal_id)
            ->where('id_user', $user->id)
            ->where('status', 'Selesai')
            ->whereMonth('tanggal_tanam', $bulan)
            ->whereYear('tanggal_tanam', $tahun)
            ->first();

        $kalender = [];

        if ($jadwal) {
            $startDate = $jadwal->tanggal_tanam;
            $endDate = Carbon::parse($startDate)->endOfMonth();

            for ($date = $startDate; $date <= $endDate; $date->addDay()) {
                $tanggal = $date->format('Y-m-d');

                // Check for validations on the given date
                $validation = Validation::where('jadwal_id', $jadwal_id)
                    ->whereDate('tanggal_terakhir_unggah', $tanggal)
                    ->first();

                // Check for image submissions (gambarTahap) on the given date
                $gambarTahap = GambarTahapan::where('jadwal_id', $jadwal_id)
                    ->whereDate('created_at', $tanggal)
                    ->first();

                // Only add to kalender if there's either validation or gambar tahapan data
                if ($validation || $gambarTahap) {
                    $kalender[$tanggal] = [
                        'hasValidation' => $validation != null,
                        'validation_time' => $validation ? $validation->created_at->format('H:i') : null,
                        'hasGambarTahap' => $gambarTahap != null,
                        'gambar_tahap_time' => $gambarTahap ? $gambarTahap->created_at->format('H:i') : null,
                    ];
                }
            }
        }

        return $kalender;
    }



    public function calender(Request $request, $jadwal_id)
    {
        // Ambil tahun dan bulan dari request, atau gunakan tahun dan bulan sekarang jika tidak ada
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month', Carbon::now()->month);

        // Pastikan nilai tahun dan bulan valid
        $date = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $date->daysInMonth;

        $monthData = [
            'name' => $date->format('F'),
            'year' => $date->year,
            'days' => [],
        ];

        // Loop untuk setiap hari dalam bulan ini
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $dayDate = Carbon::createFromDate($year, $month, $day);

            // Fetch the jadwal for this specific month and year
            $jadwal = JadwalLahan::with(['validations', 'gambarTahaps'])
                ->where('id', $jadwal_id)
                ->where('status', 'Selesai')
                ->where('id_user', Auth::id())
                ->first();

            // Initialize icons for the day
            $icons = [
                'validation' => false,
                'gambar_tahap' => false,
            ];

            if ($jadwal) {
                // Check for validation on the current day
                $validation = Validation::where('jadwal_id', $jadwal->id)
                    ->whereDate('tanggal_terakhir_unggah', $dayDate->format('Y-m-d'))
                    ->first();

                // Check for gambar tahapan on the current day
                $gambarTahap = GambarTahapan::where('jadwal_id', $jadwal->id)
                    ->whereDate('created_at', $dayDate->format('Y-m-d'))
                    ->first();

                // Set icons if data exists
                if ($validation) {
                    $icons['validation'] = true;
                }
                if ($gambarTahap) {
                    $icons['gambar_tahap'] = true;
                }
            }

            // Add the day's data with icons to the monthData
            $monthData['days'][] = [
                'day' => $day,
                'dayOfWeek' => $dayDate->format('l'),
                'icons' => $icons,  // Add the icons to the day data
            ];
        }

        // Hitung bulan dan tahun berikutnya
        $nextMonth = $date->copy()->addMonth();
        $prevMonth = $date->copy()->subMonth();

        // Fetch validations for the jadwal_id
        $validations = Validation::with('tahapan')
            ->where('jadwal_id', $jadwal->id)->get();

        // Fetch gambarTahap for the jadwal_id
        $gambarTahaps = GambarTahapan::with('tahapan')
            ->where('jadwal_id', $jadwal->id)->get();


        // Your code for generating the calendar data
        // Pass data to the view
        return view('kalender', [
            'monthData' => $monthData,
            'nextMonth' => $nextMonth,
            'prevMonth' => $prevMonth,
            'jadwal' => $jadwal,
            'validations' => $validations,
            'gambarTahaps' => $gambarTahaps,
            'year' => $year,
            'month' => $month,
        ]);
    }


    public function history()
    {
        // Query jadwal yang memiliki status 'selesai'
        $jadwalSelesai = jadwalLahan::where('status', 'Selesai')->where('id_user', Auth::id())->with('lahan')->get();

        // Kirim data ke view
        return view('data_history_jadwal', ['jadwalSelesai' => $jadwalSelesai]);
    }

}