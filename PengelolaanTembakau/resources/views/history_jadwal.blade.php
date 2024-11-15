@extends('components.template')
@section('title')
    Jadwal
@endsection
@section('pages')
    Jadwal
@endsection
@section('title-pages')
    Jadwal
@endsection
@section('content')
    <style>
        .calendar {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 600px;
            margin: auto;
            font-family: Arial, sans-serif;
        }

        .calendar-header {
            text-align: center;
            font-size: 1.5em;
            margin: 10px 0;
        }

        .calendar-row {
            display: flex;
            justify-content: space-around;
        }

        .calendar-day,
        .calendar-day-name {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2px;
            position: relative;
            border: 1px solid #ddd;
        }

        .calendar-day.empty {
            background-color: #f9f9f9;
        }

        .date {
            font-size: 0.9em;
        }

        .icon-check,
        .icon-camera {
            font-size: 0.8em;
            position: absolute;
            top: 2px;
            right: 2px;
        }

        .icon-camera {
            bottom: 2px;
            right: 2px;
            color: blue;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            max-width: 400px;
            margin: auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
    <script>
        function showDetails(date, validationTime, gambarTahapTime) {
            document.getElementById('modalDate').textContent = date;

            if (validationTime) {
                document.getElementById('validationTime').style.display = 'block';
                document.getElementById('modalValidationTime').textContent = validationTime;
            } else {
                document.getElementById('validationTime').style.display = 'none';
            }

            if (gambarTahapTime) {
                document.getElementById('gambarTahapTime').style.display = 'block';
                document.getElementById('modalGambarTahapTime').textContent = gambarTahapTime;
            } else {
                document.getElementById('gambarTahapTime').style.display = 'none';
            }

            document.getElementById('detailModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('detailModal').style.display = 'none';
        }
    </script>
    <div class="container">
        @php
            use Carbon\Carbon;

            // Pengaturan tanggal dan bulan
            $tanggalHariIni = Carbon::today();
            $tahun = $tanggalHariIni->year;
            $bulan = $tanggalHariIni->month;
            $jumlahHari = $tanggalHariIni->daysInMonth;
            $hariPertamaBulan = Carbon::create($tahun, $bulan, 1)->dayOfWeek;
            $hariDalamMinggu = ['Ming', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        @endphp
        <div class="land-schedule mb-3" style="background-color:  #e9f1f7; border-radius: 8px; padding: 15px;">
            <h5 class="mb-3">Detail Jadwal Lahan</h5>
            <p>Nama Lahan: <strong>{{ $jadwal->lahan->nama_lahan }}</strong></p>
            <p>Luas Lahan: <strong>{{ $jadwal->lahan->luas_lahan }} Hekter</strong></p>
            <p>Tanggal Penanaman: <strong>{{ $jadwal->tanggal_tanam->format('d F Y') }}</strong></p>
        </div>

        <div class="calendar" style="background-color: #e9f1f7; border-radius: 8px; padding: 15px;">
            <div class="calendar-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <!-- Tombol Back -->
                    <a href="{{ route('kalender', ['jadwal_id' => $jadwal->id, 'bulan' => $bulan - 1 < 1 ? 12 : $bulan - 1, 'tahun' => $bulan - 1 < 1 ? $tahun - 1 : $tahun]) }}"
                        class="btn btn-light">&lt; Prev</a>

                    <h3>{{ $tanggalHariIni->format('F Y') }}</h3>

                    <!-- Tombol Next -->
                    <a href="{{ route('kalender', ['jadwal_id' => $jadwal->id, 'bulan' => $bulan + 1 > 12 ? 1 : $bulan + 1, 'tahun' => $bulan + 1 > 12 ? $tahun + 1 : $tahun]) }}"
                        class="btn btn-light">Next &gt;</a>
                </div>
            </div>

            <div class="calendar-row">
                @foreach ($hariDalamMinggu as $hari)
                    <div class="calendar-day-name">{{ $hari }}</div>
                @endforeach
            </div>

            <div class="calendar-row">
                @for ($i = 0; $i < $hariPertamaBulan; $i++)
                    <div class="calendar-day empty"></div>
                @endfor

                @foreach ($monthData['days'] as $dayData)
                    @php
                        $tanggalSekarang = Carbon::create($tahun, $bulan, $dayData['day'])->format('Y-m-d');
                        $data = $kalender[$tanggalSekarang] ?? [
                            'hasValidation' => false,
                            'hasGambarTahap' => false,
                            'validation_time' => null,
                            'gambar_tahap_time' => null,
                        ];
                    @endphp

                    <div class="calendar-day"
                        @if ($data['hasValidation'] || $data['hasGambarTahap']) onclick="showDetails('{{ $tanggalSekarang }}', '{{ $data['validation_time'] ?? '' }}', '{{ $data['gambar_tahap_time'] ?? '' }}')"
                     style="cursor: pointer;" @endif>
                        <div class="date">{{ $dayData['day'] }}</div>

                        @if ($data['hasValidation'])
                            <span class="icon-check">&#10003;</span> <!-- Ikon centang -->
                        @endif

                        @if ($data['hasGambarTahap'])
                            <span class="icon-camera">&#128247;</span> <!-- Ikon kamera -->
                        @endif
                    </div>

                    @if (($dayData['day'] + $hariPertamaBulan) % 7 === 0)
            </div>
            <div class="calendar-row">
                @endif
                @endforeach
            </div>
        </div>

        <!-- Modal untuk Detail Waktu -->
        <div id="detailModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <span><strong>
                        Detail Tanggal: <span id="modalDate">
                    </strong>
                </span></span>
                <div id="validationTime" style="display: none;">
                    <strong>Waktu Validasi:</strong> <span id="modalValidationTime"></span>
                </div>
                <div id="gambarTahapTime" style="display: none;">
                    <strong>Waktu Gambar Tahap:</strong> <span id="modalGambarTahapTime"></span>
                </div>
            </div>
        </div>

    </div>
@endsection
