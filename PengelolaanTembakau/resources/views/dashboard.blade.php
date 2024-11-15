@extends('components.template')
@section('title')
    Home
@endsection
@section('pages')
    Home
@endsection
@section('title-pages')
    Home
@endsection
@section('content')
    <style>
        /* Custom styles for horizontal scroll */
        .scrolling-wrapper {
            display: flex;
            overflow-x: auto;
            padding: 10px 0;
            white-space: nowrap;
        }

        .feature-card {
            flex: 0 0 auto;
            width: 80px;
            margin: 0 8px;
            text-align: center;
        }

        .feature-card i {
            font-size: 24px;
        }

        .feature-card h6 {
            font-size: 12px;
            margin-top: 5px;
        }

        /* Hide scrollbar for better design */
        .scrolling-wrapper::-webkit-scrollbar {
            display: none;
        }

        .scrolling-wrapper {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            position: relative;
            margin-bottom: 20px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
        }



        .card .card-statistic-3 .card-icon-large .fas,
        .card .card-statistic-3 .card-icon-large .far,
        .card .card-statistic-3 .card-icon-large .fab,
        .card .card-statistic-3 .card-icon-large .fal {
            font-size: 80px;
            margin-right: 7px;
            margin-top: -10px
        }

        .card .card-statistic-3 .card-icon {
            text-align: center;
            line-height: 50px;
            margin-left: 15px;
            color: #000;
            position: absolute;
            right: -5px;
            top: 20px;
            opacity: 0.1;
        }

        /* Untuk layar besar (di atas 992px) */
        @media (min-width: 992px) {
            .scrolling-wrapper {
                justify-content: center;
                flex-wrap: wrap;
            }
        }
    </style>


    <!-- Hero Section -->
    <div class="text-center py-5">
        <h1>Selamat Datang di Sistem Pengelolaan Tembakau</h1>
        <p class="lead">Sistem terpadu untuk mengelola data lahan, hasil panen, dan jadwal perawatan tembakau
        </p>
    </div>

    <!-- Data Ringkasan -->
    <div class="row mb-4">
        <div class="col-lg-4">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <i class="fa-solid fa-seedling fa-2x mb-2"></i>
                    <h5 class="card-title">Total Lahan</h5>
                    <p class="card-text">{{ $totalLahan }} Lahan</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <i class="fa-solid fa-user fa-2x mb-2"></i>
                    <h5 class="card-title">Total Anggota Tani</h5>
                    <p class="card-text">{{ $totalAnggota }} Anggota</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-center bg-primary text-white">
                <div class="card-body">
                    <i class="fa-solid fa-users fa-2x mb-2"></i>
                    <h5 class="card-title">Total Kelompok Tani</h5>
                    <p class="card-text">{{ $totalKelompok }} Kelompok</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-3">
        <h6>Menu</h6>
        <div class="scrolling-wrapper">
            <!-- Data Lahan -->
            <a href="{{ route('lahan.index') }}" class="text-decoration-none feature-card">
                <div class=" p-2 rounded">
                    <i class="fa-solid fa-seedling"></i>
                    <h6>Data Lahan</h6>
                </div>
            </a>

            <!-- Monitoring Lahan -->
            <a href="/monitoring" class="text-decoration-none feature-card">
                <div class=" p-2 rounded">
                    <i class="fas fa-tv"></i>
                    <h6>Monitoring</h6>
                </div>
            </a>

            <!-- Data Hasil Panen -->
            <a href="/panen" class="text-decoration-none feature-card">
                <div class=" p-2 rounded">
                    <i class="fa-solid fa-scale-unbalanced"></i>
                    <h6>Hasil Panen</h6>
                </div>
            </a>

            <!-- Data Anggota Tani -->
            <a href="/anggotaTani" class="text-decoration-none feature-card">
                <div class=" p-2 rounded">
                    <i class="fa-solid fa-user"></i>
                    <h6>Anggota Tani</h6>
                </div>
            </a>

            <!-- Data Kelompok Tani -->
            <a href="/kelompokTani" class="text-decoration-none feature-card">
                <div class=" p-2 rounded">
                    <i class="fa-solid fa-users"></i>
                    <h6>Kelompok Tani</h6>
                </div>
            </a>

            <!-- Jadwal Lahan -->
            <a href="/jadwal" class="text-decoration-none feature-card">
                <div class=" p-2 rounded">
                    <i class="fas fa-calendar"></i>
                    <h6>Jadwal Lahan</h6>
                </div>
            </a>

            <!-- History Lahan -->
            <a href="/history-jadwal" class="text-decoration-none feature-card">
                <div class=" p-2 rounded">
                    <i class="fas fa-history"></i>
                    <h6>History Jadwal</h6>
                </div>
            </a>

            <!-- Tahapan -->
            <a href="/tahapan" class="text-decoration-none feature-card">
                <div class=" p-2 rounded">
                    <i class="fas fa-sync"></i>
                    <h6>Tahapan</h6>
                </div>
            </a>
        </div>
    </div>

    <!-- Jadwal Panen Aktif -->
    <div class="container mt-5">
        <h6>Jadwal Panen Aktif</h6>

        @if ($jadwalPanenAktif->isEmpty())
            <div class="alert alert-info">
                Jadwal Panen Aktif tidak ada, silakan tambahkan jadwal.
            </div>
        @else
            <div class="row">
                @foreach ($jadwalPanenAktif as $jadwal)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $jadwal->lahan->nama_lahan }}</h5>
                                <p class="card-text">Pengurus Lahan:
                                    {{ $jadwal->lahan->anggotaTani->nama_anggota }}</p>
                                <p class="card-text">Tanggal Penanaman:
                                    {{ \Carbon\Carbon::parse($jadwal->tanggal_tanam)->translatedFormat('d F Y') }}
                                </p>
                                <p class="card-text">Pupuk: {{ $jadwal->pupuk }}</p>
                                <p class="card-text">Bibit: {{ $jadwal->bibit }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
