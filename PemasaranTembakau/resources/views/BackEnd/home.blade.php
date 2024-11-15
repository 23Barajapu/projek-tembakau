<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template BackEnd</title>
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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Vendor css Files -->
    <link href="{{ asset('Template BackEnd/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <!-- Template BackEnd Main css File -->
    <link href="{{ asset('Template BackEnd/assets/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template BackEnd Name: NiceAdmin
  * Template BackEnd URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-Template BackEnd/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <x-NavAdmin></x-NavAdmin>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-6 col-md-6 mb-4"> <!-- Added bottom margin for spacing -->
                            <div class="card info-card sales-card">
                                <div class="filter px-3"> <!-- Added padding for better spacing -->
                                    <div class="d-flex justify-content-between">
                                        <form action="{{ route('sale.admin') }}" method="GET" class="me-2">
                                            <input type="hidden" name="sales_filter" value="today">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Today</button>
                                            <!-- Use outline button for better visibility -->
                                        </form>
                                        <form action="{{ route('sale.admin') }}" method="GET" class="me-2">
                                            <input type="hidden" name="sales_filter" value="month">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">This
                                                Month</button>
                                        </form>
                                        <form action="{{ route('sale.admin') }}" method="GET">
                                            <input type="hidden" name="sales_filter" value="year">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">This
                                                Year</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Sales <span class="text-muted">|
                                            @if ($salesFilter === 'month')
                                                This Month
                                            @elseif ($salesFilter === 'year')
                                                This Year
                                            @else
                                                Today
                                            @endif
                                        </span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light"
                                            style="width: 50px; height: 50px;">
                                            <i class="bi bi-cart text-primary" style="font-size: 24px;"></i>
                                            <!-- Adjusted icon size -->
                                        </div>
                                        <div class="ps-3">
                                            <h6 class="mb-0">{{ $totalSales->sum('total_sold') }}</h6>
                                            <!-- Removed bottom margin for cleaner look -->
                                            <small class="text-muted">Total Sold</small>
                                            <!-- Added a small text for clarity -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xxl-6 col-md-6 mb-4"> <!-- Added bottom margin for spacing -->
                            <div class="card info-card revenue-card">
                                <div class="filter px-3"> <!-- Added padding for better spacing -->
                                    <div class="d-flex justify-content-between">
                                        <form action="{{ route('revenue.admin') }}" method="GET" class="me-2">
                                            <input type="hidden" name="filterRevenue" value="today">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">Today</button>
                                        </form>
                                        <form action="{{ route('revenue.admin') }}" method="GET" class="me-2">
                                            <input type="hidden" name="filterRevenue" value="month">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">This
                                                Month</button>
                                        </form>
                                        <form action="{{ route('revenue.admin') }}" method="GET">
                                            <input type="hidden" name="filterRevenue" value="year">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">This
                                                Year</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Revenue <span class="text-muted">|
                                            @if ($filterRevenue === 'month')
                                                This Month
                                            @elseif ($filterRevenue === 'year')
                                                This Year
                                            @else
                                                Today
                                            @endif
                                        </span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light"
                                            style="width: 50px; height: 50px;">
                                            <i class="bi bi-currency-dollar text-primary"
                                                style="font-size: 24px;"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 class="mb-0">Rp {{ number_format($totalHarga, 0, ',', '.') }}</h6>
                                            <small class="text-muted">Total Revenue</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Revenue Card -->

                        <!-- Recent Sales -->
                        <div class="col-16">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-body">
                                    <h5 class="card-title">Recent Sales</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recentSales as $sale)
                                                <tr>
                                                    <th scope="row"><a
                                                            href="/admin/status">{{ $sale->id_pmsan }}</a>
                                                    </th>
                                                    <td>{{ $sale->nama }}</td>
                                                    <td>
                                                        @foreach ($sale->items as $item)
                                                            <a href="/barang_panen"
                                                                class="text-primary">{{ $item->keranjang->barang->nama }}</a><br>
                                                        @endforeach
                                                    </td>
                                                    <td>Rp {{ number_format($sale->total_harga, 0, ',', '.') }}
                                                    </td>
                                                    <td><span class="badge bg-success">{{ $sale->status_brg }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Recent Sales -->

                        <!-- Reports -->
                        <!-- Filter for reports -->
                        <form method="GET" action="{{ route('laporan.admin') }}">
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





                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">

                                <div class="card-body pb-0">
                                    <h5 class="card-title">Top Selling</h5>

                                    <table class="table table-borderless">
                                        <thead>
                                            <tr>
                                                <th scope="col">Preview</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Sold</th>
                                                <th scope="col">Revenue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topSellingDetails as $top)
                                                <tr>
                                                    <th scope="row"><a href="/barang_panen"><img
                                                                src="{{ asset('images/' . $top['barang']->gambar_brg) }}"
                                                                alt=""></a></th>
                                                    <td><a href="/barang_panen"
                                                            class="text-primary fw-bold">{{ $top['barang']->nama }}</a>
                                                    </td>
                                                    <td class="fw-bold">{{ $top['total_sold'] }}</td>
                                                    <td>Rp
                                                        {{ number_format($top['barang']->harga * $top['total_sold'], 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                        </div><!-- End Top Selling -->

                    </div><!-- End Left side columns -->
                </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-Template BackEnd/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('Template BackEnd/assets/js/main.js') }}"></script>
</body>

</html>
