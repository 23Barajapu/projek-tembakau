@extends('components.template')
@section('title')
    Monitoring
@endsection
@section('pages')
    Monitoring
@endsection
@section('title-pages')
    Monitoring
@endsection
@section('content')
    <style>
        .card {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            position: relative;
            margin-bottom: 30px;
            box-shadow: 0 0.46875rem 2.1875rem rgba(90, 97, 105, 0.1), 0 0.9375rem 1.40625rem rgba(90, 97, 105, 0.1), 0 0.25rem 0.53125rem rgba(90, 97, 105, 0.12), 0 0.125rem 0.1875rem rgba(90, 97, 105, 0.1);
        }



        .card .card-statistic-3 .card-icon-large .fas,
        .card .card-statistic-3 .card-icon-large .far,
        .card .card-statistic-3 .card-icon-large .fab,
        .card .card-statistic-3 .card-icon-large .fal {
            font-size: 80px;
            margin-right: 7px;
            margin-top: -17px
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

        .icon-bell {
            position: absolute;
            margin-left: 110px;
            margin-top: -15px;
            font-size: 24px;
        }

        .card-bell {
            text-align: center;
            margin-left: 10px;
            position: absolute;
            right: 10px;
            top: 15px;
            display: inline-block;
        }

        .notification-count {
            position: absolute;
            top: -3px;
            right: -9px;
            background-color: red;
            color: white;
            font-size: 12px;
            border-radius: 50%;
            min-width: 15px;
            min-height: 15px;
            text-align: center;
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

    <div class="container-fluid py-4">
        <h5 class="py-3">Daftar Monitoring Lahan</h5>
        @if ($lahanData->isEmpty())
            <div class="alert alert-info">
                Daftar sedang tidak tersedia, silakan tambahkan jadwal lahan terlebih dahulu.
            </div>
        @else
            <div class="row">

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
                    integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

                <div class="container">

                    <div class="row ">
                        @foreach ($lahanData as $data)
                            <div class="col-4 col-lg-2">
                                <a href="{{ route('monitoring.detail', $data->id) }}" style="text-decoration: none;">
                                    <div class="card l-bg-cherry">
                                        <div class="card-statistic-3 p-4">
                                            <div class="card-icon card-icon-large"><i class="fas fa-leaf"></i></div>
                                            <div class="card-bell icon-bell">
                                                <i class="fas fa-bell"></i>
                                                {{-- <span class="notification-count">5</span> --}}
                                            </div>

                                            <div class="mb-2">
                                                <h5 class="card-title mb-0">{{ $data->lahan->nama_lahan }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="lahanContainer" class="row"></div>
                <!-- Loop 20 cards -->
            </div>
        @endif
    </div>
@endsection
