<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Daftar Barang</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('Template BackEnd/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('Template BackEnd/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor css Files -->
    <link href="{{ asset('Template BackEnd/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
        }

        .container {
            margin-top: 30px;
        }

        .card {
            margin-bottom: 20px;
        }

        .status {
            font-weight: bold;
        }
    </style>
    <!-- Template BackEnd Main css File -->
    <link href="{{ asset('Template BackEnd/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <x-navadmin></x-navadmin>
    <main id="main" class="main">
        <div class="container">
            <div class="pagetitle">
                <h1>Laporan</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/laporan">Laporan</a></li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <!-- Filter untuk tabel laporan -->
            <h4>Tabel Laporan</h4>
            <form method="GET" action="{{ route('laporan.index') }}">
                <div class="row">
                    <div class="col-md-5">
                        <label for="start_date">Tanggal Mulai:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-5">
                        <label for="end_date">Tanggal Akhir:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control"
                            value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <!-- Tombol Export PDF -->
            <form method="GET" action="{{ route('laporan.export') }}">
                <!-- Hidden input untuk tanggal filter -->
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                <button type="submit" class="btn btn-danger mt-3">Export PDF</button>
            </form>

            @if ($pemesanan->isEmpty())
                <div class="mt-3 alert alert-warning">
                    <strong>Peringatan!</strong> Tidak ada pemesanan di laporan.
                </div>
            @else
                <div class="table-responsive mt-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Pemesanan</th>
                                <th>Nama</th>
                                <th>Barang</th>
                                <th>Sub Total</th>
                                <th>Harga Pengiriman</th>
                                <th>Total Harga</th>
                                <th>Tanggal Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanan as $data)
                                <tr>
                                    <td>{{ $loop->index + 1 + ($pemesanan->currentPage() - 1) * $pemesanan->perPage() }}
                                    </td>
                                    <td>{{ $data->id_pmsan }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>
                                        @foreach ($data->items as $item)
                                            <li class="py-2 d-flex flex-wrap">
                                                <div class="px-3">
                                                    <strong>{{ $item->keranjang->barang->nama }}</strong>
                                                    <span>- x{{ $item->keranjang->jumlah }}</span>
                                                    <span>Rp{{ number_format($item->keranjang->barang->harga, 0, ',', '.') }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </td>
                                    <td>Rp{{ number_format($data->total_harga - $data->harga_layanan, 0, ',', '.') }}
                                    </td>
                                    <td>Rp{{ number_format($data->harga_layanan, 0, ',', '.') }}</td>
                                    <td>Rp{{ number_format($data->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->tgl_pmsan)->format('d F Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $pemesanan->links('pagination::bootstrap-5') }}
            @endif


            <!-- Filter untuk grafik laporan -->
            <hr>
            <h4 class="mt-5">Grafik Keuangan</h4>
            <form method="GET" action="{{ route('laporan.index') }}">
                <label for="filter">Filter by:</label>
                <select name="filter" id="filter" class="form-select" onchange="this.form.submit()">
                    <option value="day" {{ $filter == 'day' ? 'selected' : '' }}>Day</option>
                    <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Month</option>
                    <option value="year" {{ $filter == 'year' ? 'selected' : '' }}>Year</option>
                </select>
            </form>


            <!-- Reports Chart -->
            <div class="col-xxl-16 col-lg-16 col-md-16 col-xl-16 chart-container"
                style="position: relative; height:400px; width:100%">
                <canvas id="reportsChart"></canvas>
            </div>

            <!-- Include Chart.js from CDN -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                // Prepare data for the chart
                const reports = @json($reports);
                const labels = reports.map(report => report.period); // period is now formatted (e.g., '28 Agustus 2024', 'Januari')
                const data = reports.map(report => report.total_harga);

                // Create gradient fill for the bars
                const ctx = document.getElementById('reportsChart').getContext('2d');
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(75, 192, 192, 0.5)');
                gradient.addColorStop(1, 'rgba(153, 102, 255, 0.5)');

                // Create the chart
                const reportsChart = new Chart(ctx, {
                    type: 'bar', // You can change to 'line', 'pie', etc.
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Harga',
                            data: data,
                            backgroundColor: gradient, // Gradient fill
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            borderRadius: 5, // Make bars rounded
                            hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)', // Change color on hover
                        }]
                    },
                    options: {
                        plugins: {
                            tooltip: {
                                enabled: true,
                                backgroundColor: 'rgba(0, 0, 0, 0.7)',
                                titleColor: '#fff',
                                bodyColor: '#fff',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            legend: {
                                display: true,
                                labels: {
                                    color: '#333',
                                    font: {
                                        size: 14
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    color: 'rgba(0, 0, 0, 0.1)',
                                },
                                title: {
                                    display: true,
                                    text: 'Total Harga (Rp)',
                                    color: '#333',
                                    font: {
                                        size: 16
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false,
                                },
                                title: {
                                    display: true,
                                    text: '{{ ucfirst($filter) }}', // Display 'Day', 'Month', or 'Year'
                                    color: '#333',
                                    font: {
                                        size: 16
                                    }
                                }
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            </script>

        </div>
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('Template BackEnd/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Template BackEnd Main JS File -->
    <script src="{{ asset('Template BackEnd/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
