@extends('components.template')
@section('title')
    Monitoring
@endsection
@section('pages')
    Monitoring
@endsection
@section('title-pages')
    Detail Monitoring
@endsection
@section('content')
    <style>
        /* Container untuk tab */
        .notification-tab {
            display: flex;
            border-bottom: 2px solid #ccc;
            width: 100%;
            justify-content: center;

        }

        /* Gaya umum untuk setiap item tab */
        .tab-item {
            padding: 10px 20px;
            cursor: pointer;
            color: #7c7c7c;
            font-weight: bold;
            transition: color 0.3s ease, border-bottom 0.3s ease;
        }

        /* Gaya untuk tab yang aktif */
        .tab-item.active {
            color: #0a0a0a;
            /* Warna biru */
            border-bottom: 2px solid #090909;
        }

        /* Efek hover untuk tab */
        .tab-item:hover {
            color: #010101;
        }


        /* Warna kuning */
        .border-warning {
            border: 5px solid yellow;
            background-color: rgb(250, 250, 152);
        }

        /* Warna merah */
        .border-danger {
            border: 5px solid red;
            background-color: rgba(237, 184, 184, 0.882);
        }

        .border-late {
            border: 5px solid red;
            background-color: rgba(237, 184, 184, 0.882);
        }

        /* Warna merah dengan efek berkedip */
        .blink {
            animation: blink-effect 1s linear infinite;
        }

        /* Animasi berkedip */
        @keyframes blink-effect {
            50% {
                opacity: 0;
            }
        }
    </style>
    <script>
        // Set jumlah notifikasi
        const notificationCount = 5; // Misalnya, dari hasil fetch data
        document.querySelector('.notification-count').textContent = notificationCount;
    </script>
    <script>
        function showTab(tab) {
            // Mengubah tab yang aktif
            document.querySelectorAll('.tab-item').forEach(item => item.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.style.display = 'none');

            // Menampilkan konten yang sesuai dengan tab
            document.getElementById(tab + '-tab').style.display = 'block';
            document.querySelector('.tab-item[onclick="showTab(\'' + tab + '\')"]').classList.add('active');
        }
    </script>

    <style>
        .tab-item {
            display: inline-block;
            padding: 8px 16px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }

        .tab-item.active {
            font-weight: bold;
            border-bottom: 2px solid #007bff;
        }

        .tab-content {
            display: none;
        }
    </style>



    <div class="container-fluid py-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <!-- Tombol Back dengan Ikon Saja -->
            <div class="d-flex align-items-center">
                <button onclick="goBack()" class="btn btn-lg p-2 me-2 fa-2x">
                    <i class="fas fa-arrow-left" style="font-size: 20px"></i>
                </button>
            </div>

            <!-- Tab Notifikasi dan Jadwal -->
            <div class="notification-tab d-flex">
                <div class="tab-item active me-2" onclick="showTab('notification')">Notifikasi</div>
                <div class="tab-item" onclick="showTab('schedule')">Jadwal</div>
            </div>
        </div>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        @vite(['resources/js/app.js'])

        @foreach ($tahapan as $item)
            <!-- Notifikasi -->
            <div id="notification-tab" class="tab-content" style="display: block;">
                <div class="notification-list">
                    <!-- Notifikasi Tahapan-->
                    <div id="notification-tab" class="tab-content" style="display: block;">
                        @php
                            $currentDate = now();

                        @endphp

                        <div id="notification-tab" class="tab-content" style="display: block;">
                            <div class="notification-list">

                                @php
                                    //dd($item->tahapBerikutnya, $item->daysSinceStart);
                                    $itemBerikutnya = $item->tahapBerikutnya;

                                    $isOngoing = $currentDate->between($item->startDate, $item->endDate);

                                    if ($gambar) {
                                        // Jika gambar ditemukan, ambil tanggal terakhir unggah
                                        $tanggalTerakhir = $gambar->tanggal_terakhir_unggah;
                                        $tanggalTerakhirUnggah = $tanggalTerakhir == today(); // true jika gambar diunggah hari ini
                                        $showNotification = false; // true jika gambar tidak diunggah hari ini
                                    } else {
                                        // Jika tidak ditemukan, atur tanggalTerakhirUnggah ke false dan showNotification ke true
                                        $tanggalTerakhirUnggah = false;
                                        $showNotification = true; // tampilkan notifikasi karena tidak ada gambar
                                    }
                                    // Asumsikan bahwa $item->endDate adalah objek Carbon yang sudah terdefinisi
                                    $currentDate = now(); // Tanggal sekarang

                                    // Hitung selisih antara currentDate dan endDate
                                    $daysUntilEnd1 = $currentDate->diffInDays($item->endDate); // 'false' untuk menghitung arah yang lebih besar (positif jika endDate lebih besar)
                                    //$daysUntilEnd = floor($currentDate->diffInDays($item->endDate) + 2);
                                    $daysUntilEnd = 5;

                                    $RentangTahap = [10, 3, 1]; // Nilai yang akan memicu notifikasi

                                    // Tentukan warna background berdasarkan rentang hari
                                    $backgroundColor = '';
                                    if ($daysUntilEnd == 10) {
                                        $backgroundColor = '#ffffff'; // Warna putih untuk rentang 10
                                    } elseif ($daysUntilEnd <= 3 && $daysUntilEnd > 1) {
                                        $backgroundColor = '#ffc107'; // Warna kuning pekat untuk rentang 3
                                    } elseif ($daysUntilEnd <= 1) {
                                        $backgroundColor = '#dc3545'; // Warna merah pekat untuk rentang 1
                                    }
                                @endphp


                                @if ($isOngoing)
                                    <style>
                                        /* Efek blink untuk teks */
                                        .blink {
                                            animation: blink-animation 1s steps(5, start) infinite;
                                            -webkit-animation: blink-animation 1s steps(5, start) infinite;
                                        }

                                        /* Keyframes untuk efek blink */
                                        @keyframes blink-animation {
                                            to {
                                                visibility: hidden;
                                            }
                                        }

                                        @-webkit-keyframes blink-animation {
                                            to {
                                                visibility: hidden;
                                            }
                                        }
                                    </style>

                                    <div class="notification-item d-flex flex-column p-3 mb-2 blink"
                                        style="background-color: #dc3545; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                        <div class="d-flex align-items-center">
                                            <div class="notification-icon me-3">
                                                <i class="fas fa-exclamation-circle text-warning"
                                                    style="font-size: 1rem;"></i>
                                            </div>
                                            <div class="notification-content">
                                                <h6 class="mb-1" style="font-weight: 600; color: #ffffff;">Tahap
                                                    Sedang Berlangsung</h6>
                                                <small class="text-light">{{ $lahan->nama_lahan }} -
                                                    {{ $lahan->anggotaTani->nama_anggota }}</small>
                                            </div>
                                        </div>
                                        <div class="notification-detail mt-2">
                                            <p class="mb-1" style="font-size: 1rem; color: #ffffff;">Tahap ini sedang
                                                berlangsung saat ini.</p>
                                            <p class="mb-0" style="color: #ffffff;"><strong>Nama Tahap:</strong>
                                                {{ $item->nama_tahap }}</p>
                                            <p class="mb-0" style="color: #ffffff;"><strong>Deskripsi:</strong>
                                                {{ $item->deskripsi }}</p>
                                        </div>
                                    </div>

                                    @if ($daysUntilEnd <= 10 && $daysUntilEnd >= 1)
                                        <div class="notification-item d-flex flex-column p-3 mb-2"
                                            style="background-color: {{ $backgroundColor }}; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                            <div class="d-flex align-items-center">
                                                <div class="notification-icon me-3">
                                                    <i class="fas fa-exclamation-circle text-warning"
                                                        style="font-size: 1rem;"></i>
                                                </div>
                                                <div class="notification-content">
                                                    <h6 class="mb-1" style="font-weight: 600;">Pengingat Tahap Berikutnya
                                                    </h6>
                                                    <small class="text-muted">{{ $lahan->nama_lahan }} -
                                                        {{ $lahan->anggotaTani->nama_anggota }}</small>
                                                </div>
                                            </div>
                                            <div class="notification-detail mt-2">
                                                <p class="mb-1" style="font-size: 1rem;">Tahap berikutnya akan berlangsung
                                                    dalam
                                                    {{ $daysUntilEnd }} hari lagi.</p>
                                                <p class="mb-0"><strong>Nama Tahap:</strong>
                                                    {{ $item->tahapBerikutnya->nama_tahap }}</p>
                                                <p class="mb-0"><strong>Deskripsi:</strong>
                                                    {{ $item->tahapBerikutnya->deskripsi }}</p>
                                            </div>
                                        </div>
                                    @endif


                                    @if ($item->daysSinceStart == 1 && $showNotification == true)
                                        <!-- Notifikasi Unggah Gambar pada Hari ke-1 -->
                                        <div class="notification-item d-flex flex-column p-3 mb-2"
                                            style="background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                            <div class="d-flex align-items-center">
                                                <div class="notification-icon me-3">
                                                    <i class="fas fa-camera text-info"></i>
                                                </div>
                                                <div class="notification-content">
                                                    <h6 class="mb-1">Penyelesaian Tahapan: {{ $item->nama_tahap }}</h6>
                                                    <small class="text-muted">Hari ke {{ $item->daysSinceStart }} tahap ini
                                                        pada
                                                        {{ $lahanData->lahan->nama_lahan }}
                                                        ({{ $lahan->AnggotaTani->nama_anggota }})
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="notification-detail mt-2">
                                                <p class="mb-0">Tanggal Mulai:
                                                    <strong>{{ $item->tanggal_mulai }}</strong>
                                                </p>
                                                <p class="mb-0">Harap unggah gambar untuk menyelesaikan tahapan pada hari
                                                    ini.</p>
                                                <button class="btn btn-primary mt-3" id="uploadGambar">Tambah Foto</button>

                                                <!-- Area upload gambar tersembunyi -->
                                                <div id="upload" class="d-none mt-2">
                                                    <form
                                                        action="{{ route('validasi.gambar', ['id_tahap' => $item->id, 'id_jadwal' => $lahanData->id]) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="file" name="gambar" required><br>
                                                        <button type="submit" class="mt-2 btn btn-primary">Upload
                                                            Gambar</button>
                                                    </form>
                                                </div>

                                                <script>
                                                    document.getElementById('uploadGambar').addEventListener('click', function() {
                                                        const uploadSection = document.getElementById('upload');
                                                        uploadSection.classList.toggle('d-none');
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($item->daysSinceStart != 1 && $item->val == false)
                                        <!-- Notifikasi Validasi Harian -->
                                        <div class="notification-item d-flex flex-column p-3 mb-2"
                                            style="background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                            <div class="d-flex align-items-center">
                                                <div class="notification-icon me-3">
                                                    <i class="fas fa-exclamation-circle text-warning"></i>
                                                </div>
                                                <div class="notification-content">
                                                    <h6 class="mb-1">Validasi Harian untuk Tahapan:
                                                        {{ $item->nama_tahap }}</h6>
                                                    <small class="text-muted">Hari ke-{{ $item->daysSinceStart }} tahap
                                                        ini. {{ $lahanData->lahan->nama_lahan }}
                                                        ({{ $lahan->AnggotaTani->nama_anggota }}).</small>
                                                </div>
                                            </div>
                                            <div class="notification-detail mt-2">
                                                <p class="mb-0">Tanggal:
                                                    <strong>{{ $currentDate->format('d F Y') }}</strong>
                                                </p>
                                                <p class="mb-0">Klik tombol validasi untuk melanjutkan tahapan hari ini.
                                                </p>
                                                <form
                                                    action="{{ route('validasi.tahap', ['id_tahap' => $item->tahapDetail->id, 'id_jadwal' => $lahanData->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="hari" id="hari"
                                                        value="{{ $item->daysSinceStart }}">
                                                    <button type="submit" class="btn btn-warning mt-3">Validasi</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- Notifikasi Peringatan Hama, Virus dan Ulat -->
                    @php
                        // Ambil total hari dari tabel tahapan
                        $tahapan = \App\Models\Tahapan::orderBy('selesai', 'desc')->first(); // Ambil tahapan terakhir
                        $totalDays = $tahapan ? $tahapan->selesai : 0;
                        $tanggalTanam = $jadwal->tanggal_tanam;

                        // Hitung hari-hari untuk notifikasi
                        $currentDate = now()->format('Y-m-d'); // Format tanggal saat ini
                        $notificationDays = [];

                        // Loop untuk menghitung hari setiap 3 hari hingga total hari
                        for ($i = 3; $i <= $totalDays; $i += 3) {
                            $notificationDays[] = $tanggalTanam->addDays($i)->format('Y-m-d'); // Format tanggal untuk perbandingan
                        }

                        // Ambil tanggal yang telah ditampilkan sebelumnya
                        $lastNotificationDate = session('last_notification_date', null);
                    @endphp

                    @foreach ($notificationDays as $day)
                        @if ($day == $currentDate && $day !== $lastNotificationDate)
                            <!-- Menampilkan notifikasi jika tanggal sama dengan hari ini dan bukan tanggal notifikasi terakhir -->
                            <!-- Notifikasi untuk peringatan virus, hama, dan ulat -->
                            <div class="notification-item d-flex flex-column p-3 mb-2"
                                style="background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                <div class="d-flex align-items-center">
                                    <div class="notification-icon me-3">
                                        <i class="fas fa-exclamation-circle text-danger"></i>
                                    </div>
                                    <div class="notification-content">
                                        <h6 class="mb-1">Peringatan: Virus, Hama, dan Ulat!</h6>
                                        <small class="text-muted">Notifikasi akan muncul setiap 3 hari sekali.</small>
                                    </div>
                                </div>
                                <div class="notification-detail mt-2">
                                    <p class="mb-0">Tanggal Peringatan:
                                        <strong>{{ \Carbon\Carbon::parse($day)->format('d F Y') }}</strong>
                                    </p>
                                    <p class="mb-0">Harap memeriksa tanaman tembakau Anda untuk memantau adanya
                                        virus, hama, dan ulat pada
                                        {{ $lahanData->lahan->nama_lahan }}
                                        ({{ $lahan->AnggotaTani->nama_anggota }})
                                        .</p>
                                </div>
                            </div>

                            @php
                                // Simpan tanggal notifikasi terakhir ke session
                                session(['last_notification_date' => $day]);
                            @endphp
                        @endif
                    @endforeach

                    <!-- Notifikasi 1
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="notification-item d-flex flex-column p-3 mb-2"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            style="background-color: #f8f9fa; border-radius: 8px;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="d-flex align-items-center">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="notification-icon me-3">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class="fas fa-exclamation-circle text-warning"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="notification-content">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <h6 class="mb-1">Penyiraman Pupuk Terjadwal</h6>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <small class="text-muted">Lahan 12 - 20 menit yang lalu</small>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="notification-detail mt-2">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p class="mb-0">Tanggal Pelaksanaan: <strong>30 Oktober 2024</strong></p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p class="mb-0">Detail: Penyiraman pupuk organik yang terjadwal untuk meningkatkan kesuburan
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    tanah
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    di
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    Lahan 12.</p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>-->

                    <!-- Notifikasi 2
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="notification-item d-flex flex-column p-3 mb-2"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            style="background-color: #f8f9fa; border-radius: 8px;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="d-flex align-items-center">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="notification-icon me-3">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class="fas fa-seedling text-success"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="notification-content">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <h6 class="mb-1">Penyemaian Benih Selesai</h6>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <small class="text-muted">Lahan 5 - 1 jam yang lalu</small>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="notification-detail mt-2">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p class="mb-0">Tanggal Pelaksanaan: <strong>29 Oktober 2024</strong></p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p class="mb-0">Detail: Penyemaian benih selesai di Lahan 5. Pantau kondisi bibit untuk
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    perkembangan
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    optimal.</p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>-->

                    <!-- Notifikasi 3
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="notification-item d-flex flex-column p-3 mb-2"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            style="background-color: #f8f9fa; border-radius: 8px;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="d-flex align-items-center">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="notification-icon me-3">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class="fas fa-thermometer-half text-danger"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="notification-content">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <h6 class="mb-1">Suhu Tanah Meningkat</h6>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <small class="text-muted">Lahan 8 - 3 jam yang lalu</small>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="notification-detail mt-2">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p class="mb-0">Tanggal Pelaksanaan: <strong>28 Oktober 2024</strong></p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p class="mb-0">Detail: Suhu tanah di Lahan 8 mengalami kenaikan signifikan. Evaluasi sistem
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    irigasi
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    untuk pendinginan.</p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>-->

                    <!-- Notifikasi 4
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="notification-item d-flex flex-column p-3 mb-2"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            style="background-color: #f8f9fa; border-radius: 8px;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="d-flex align-items-center">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="notification-icon me-3">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <i class="fas fa-leaf text-primary"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="notification-content">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <h6 class="mb-1">Pemantauan Hama Diperlukan</h6>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <small class="text-muted">Lahan 3 - 5 jam yang lalu</small>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div class="notification-detail mt-2">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p class="mb-0">Tanggal Pelaksanaan: <strong>27 Oktober 2024</strong></p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <p class="mb-0">Detail: Pemantauan hama di Lahan 3 perlu segera dilakukan untuk mencegah
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    kerusakan
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    tanaman.</p>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>-->

                </div>
            </div>

            <!-- Jadwal -->

            <div id="schedule-tab" class="tab-content" style="display: none;">
                <div class="land-schedule mb-3" style="background-color: #f0f4f8; border-radius: 8px; padding: 15px;">
                    <h5 class="mb-3">Detail Jadwal Lahan</h5>
                    <p>Nama Lahan: <strong>{{ $lahanData->lahan->nama_lahan }}</strong></p>
                    <p>Luas Lahan: <strong>{{ $lahanData->lahan->luas_lahan }} Hekter</strong></p>
                    <p>Pemilik Lahan: <strong>{{ $lahan->AnggotaTani->nama_anggota }}</strong></p>
                    <p>Tanggal Penanaman: <strong>{{ $lahanData->tanggal_tanam->format('d F Y') }}</strong></p>
                </div>

                <div class="schedule-list">
                    @foreach ($tahap as $item)
                        <div class="schedule-item d-flex flex-column p-3 mb-3"
                            style="background-color: #e9f7ef; border-radius: 8px;">
                            <h6 class="mb-2">Tahap ke {{ $item->tahap }} : {{ $item->nama_tahap }}</h6>
                            <p>Rentang Tanggal: <strong>{{ $item->tanggal_mulai }} - {{ $item->tanggal_selesai }}</strong>
                            </p>

                            @php
                                $currentDate = now();
                                $startDate = \Carbon\Carbon::parse($item->tanggal_mulai);
                                $endDate = \Carbon\Carbon::parse($item->tanggal_selesai);

                                $uploadedImages = \App\Models\GambarTahapan::where('tahapan_id', $item->id)
                                    ->where('jadwal_id', $jadwal->id)
                                    ->get();
                                $imageCount = $uploadedImages->count();
                                $isImageUploaded = $imageCount > 0;
                                $isValidated = $item->is_validated; // Misal, terdapat kolom validasi di item

                                // Hitung selisih antara currentDate dan endDate
                                $daysUntilEnd1 = $currentDate->diffInDays($item->endDate); // 'false' untuk menghitung arah yang lebih besar (positif jika endDate lebih besar)
                                $daysUntilEnd = floor($currentDate->diffInDays($item->endDate) + 2);
                            @endphp

                            @if ($currentDate->isAfter($endDate))
                                <p>Status: <strong class="text-success">Selesai <i
                                            class="fas fa-check-circle"></i></strong>
                                </p>
                            @elseif ($currentDate->isBefore($startDate) && $daysUntilEnd <= 10 && $daysUntilEnd >= 1)
                                <p>Status: <strong class="text-warning">Segera <i class="fas fa-clock"></i></strong></p>
                            @elseif ($currentDate->isBefore($startDate))
                                <p>Status: <strong class="text">Dijadwalkan <i class="fas fa-calendar-alt"></i></strong>
                                </p>
                            @else
                                <p>Status: <strong class="text-danger">Sedang Berlangsung <i
                                            class="fas fa-spinner"></i></strong></p>
                            @endif

                            <p>Deskripsi: {{ $item->deskripsi }}</p>

                            <!-- Carousel untuk menampilkan gambar -->
                            @if ($uploadedImages->isEmpty())
                                @if (
                                    $imageCount < 3 &&
                                        !$isValidated &&
                                        !$isImageUploaded &&
                                        $currentDate->isAfter($startDate) &&
                                        $currentDate->isBefore($endDate))
                                    <button class="btn btn-primary mt-3" id="uploadBtn{{ $loop->index + 1 }}">Tambah
                                        Foto</button>
                                @else
                                    <div class="mt-3"></div>
                                @endif


                                <!-- Area upload gambar tersembunyi -->
                                <div id="uploadSection{{ $loop->index + 1 }}" class="d-none mt-2">

                                    <form
                                        action="{{ route('validasi.gambar', ['id_tahap' => $item->id, 'id_jadwal' => $lahanData->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="gambar" required><br>
                                        <button type="submit" class="mt-2 btn btn-primary">Upload
                                            Gambar</button>
                                    </form>
                                </div>

                                <script>
                                    document.getElementById('uploadBtn{{ $loop->index + 1 }}').addEventListener('click', function() {
                                        const uploadSection = document.getElementById('uploadSection{{ $loop->index + 1 }}');
                                        uploadSection.classList.toggle('d-none');
                                    });
                                </script>
                            @else
                                <div id="imageCarousel{{ $loop->index + 1 }}" class="carousel slide mt-3"
                                    data-bs-ride="carousel">
                                    <div class="carousel-inner" id="carouselImages{{ $loop->index + 1 }}">
                                        @foreach ($uploadedImages as $key => $image)
                                            @if ($key < 3)
                                                <!-- Batasi hanya menampilkan 3 gambar -->
                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $image->nama) }}"
                                                        class="d-block w-100" style="height: 250px"
                                                        alt="Gambar {{ $key + 1 }}">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#imageCarousel{{ $loop->index + 1 }}" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#imageCarousel{{ $loop->index + 1 }}" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>

                                @if (
                                    $imageCount < 3 &&
                                        !$isValidated &&
                                        !$isImageUploaded &&
                                        $currentDate->isAfter($startDate) &&
                                        $currentDate->isBefore($endDate))
                                    <button class="btn btn-primary mt-3" id="uploadBtn{{ $loop->index + 1 }}">Tambah
                                        Foto</button>
                                @else
                                    <div class="mt-3"></div>
                                @endif


                                <!-- Area upload gambar tersembunyi -->
                                <div id="uploadSection{{ $loop->index + 1 }}" class="d-none mt-2">

                                    <form
                                        action="{{ route('validasi.gambar', ['id_tahap' => $item->id, 'id_jadwal' => $lahanData->id]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="gambar" required><br>
                                        <button type="submit" class="mt-2 btn btn-primary">Upload
                                            Gambar</button>
                                    </form>
                                </div>

                                <script>
                                    document.getElementById('uploadBtn{{ $loop->index + 1 }}').addEventListener('click', function() {
                                        const uploadSection = document.getElementById('uploadSection{{ $loop->index + 1 }}');
                                        uploadSection.classList.toggle('d-none');
                                    });
                                </script>
                            @endif
                        </div>
                    @endforeach
                </div>



            </div>
        @endforeach
    </div>
@endsection
