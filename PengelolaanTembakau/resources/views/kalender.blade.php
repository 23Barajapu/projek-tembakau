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
        .calendar-container {
            width: 100%;
            max-width: 600px;
            margin: auto;
        }

        .month {
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            text-align: center;
        }

        .day {
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 5px;
            position: relative;
            cursor: pointer;
        }

        .icon-check,
        .icon-camera {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 1.2em;
            color: green;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-size: 1em;
        }

        /* Modal Styles */
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
            font-size: 28px;
            font-weight: bold;
            float: right;
            cursor: pointer;
        }
    </style>

    <div class="container">
        <div class="land-schedule mb-3" style="background-color: #e9f1f7; border-radius: 8px; padding: 15px;">
            <h5 class="mb-3">History Jadwal Lahan</h5>
            <p>Nama Lahan: <strong>{{ $jadwal->lahan->nama_lahan }}</strong></p>
            <p>Luas Lahan: <strong>{{ $jadwal->lahan->luas_lahan }} Hekter</strong></p>
            <p>Tanggal Penanaman: <strong>{{ $jadwal->tanggal_tanam->format('d F Y') }}</strong></p>
        </div>

        <h5 style="text-align:center;">Kalender {{ $monthData['name'] }} {{ $monthData['year'] }}</h5>

        <div class="calendar-container">
            <div class="navigation">
                <a
                    href="{{ route('calendar.index', ['jadwal_id' => $jadwal->id, 'year' => $prevMonth->year, 'month' => $prevMonth->month]) }}">
                    << Previous </a>
                        <a
                            href="{{ route('calendar.index', ['jadwal_id' => $jadwal->id, 'year' => $nextMonth->year, 'month' => $nextMonth->month]) }}">
                            Next >>
                        </a>
            </div>

            <div class="days">
                @foreach ($monthData['days'] as $day)
                    <div class="day" data-day="{{ $day['day'] }}"
                        onclick="showModal('{{ $day['day'] }}', 
                        { 
                            validation: @json($validations[$day['day']] ?? null), 
                            gambar_tahap: @json($gambarTahaps[$day['day']] ?? null) 
                        })">
                        {{ $day['day'] }} <br>
                        <small>{{ $day['dayOfWeek'] }}</small>

                        @if ($day['icons']['validation'])
                            <i class="icon-check">✔️</i>
                            {{-- <a href="">{{ $day['icons']['validation'] }}</a> --}}
                        @endif

                        @if ($day['icons']['gambar_tahap'])
                            <i class="icon-camera">📸</i>
                        @endif
                    </div>
                @endforeach
            </div>


        </div>

        <!-- Modal -->
        {{-- <div id="detailModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h5>Detail Tanggal: <span id="modalDate"></span></h5>

                <div id="validationTime" style="display: none;">
                    <strong>Waktu Validasi:</strong> <span id="modalValidationTime"></span><br>
                    <strong>Tahapan:</strong> <span id="modalValidationTahapan"></span>
                </div>

                <div id="gambarTahapTime" style="display: none;">
                    <strong>Waktu Gambar Tahap:</strong> <span id="modalGambarTahapTime"></span><br>
                    <strong>Tahapan:</strong> <span id="modalGambarTahapTahapan"></span>
                </div>
            </div>
        </div> --}}

        {{-- <script>
            function showModal(day, icons, validation) {
                document.getElementById('modalDate').textContent = day;

                const validationData = validation;
                const gambarTahapData = icons.gambar_tahap;

                if (validationData) {
                    document.getElementById('validationTime').style.display = 'block';
                    document.getElementById('modalValidationTime').textContent = validationData.tanggal_terakhir_unggah ||
                        'Tidak ada waktu validasi';
                    document.getElementById('modalValidationTahapan').textContent = validationData.tahapan.nama_tahapan ||
                        'Tidak ada tahapan';
                } else {
                    document.getElementById('validationTime').style.display = 'none';
                }

                if (gambarTahapData) {
                    document.getElementById('gambarTahapTime').style.display = 'block';
                    document.getElementById('modalGambarTahapTime').textContent = gambarTahapData.created_at ||
                        'Tidak ada waktu gambar tahap';
                    document.getElementById('modalGambarTahapTahapan').textContent = gambarTahapData.tahapan.nama_tahapan ||
                        'Tidak ada tahapan';
                } else {
                    document.getElementById('gambarTahapTime').style.display = 'none';
                }

                document.getElementById('detailModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('detailModal').style.display = 'none';
            }
        </script> --}}

    </div>
@endsection
