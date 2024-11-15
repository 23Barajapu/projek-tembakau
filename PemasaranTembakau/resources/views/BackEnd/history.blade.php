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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
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
                <h1>History Pemesanan</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/admin/history">History Pemesanan</a></li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            @if ($pemesanans->isEmpty())
                <div class="alert alert-warning">
                    <strong>Peringatan!</strong> Tidak ada pemesanan di history.
                </div>
            @else
                <!-- Tabel Pemesanan -->
                <div class="table-responsive divScroll">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>ID Pemesanan</th>
                                <th>Detail</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Total Harga</th>
                                <th>Status Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemesanans as $pemesanan)
                                <tr>
                                    <td>{{ $pemesanan->id_pmsan }}</td>
                                    <td>

                                        <details>
                                            <summary>Lihat Detail</summary>
                                            <div class="card card-body mt-2">
                                                <h5 class="mt-3">Detail Pelanggan:</h5>
                                                <p><strong>Nama:</strong> {{ $pemesanan->nama }}</p>
                                                <p><strong>Telepon:</strong> {{ $pemesanan->telepon }}</p>
                                                <p><strong>Alamat:</strong> {{ $pemesanan->alamat }}</p>
                                                <p><strong>Tanggal Pemesanan:</strong>
                                                    {{ \Carbon\Carbon::parse($pemesanan->tgl_pmsan)->format('d M Y') }}
                                                </p>

                                                <h5>Detail Barang:</h5>
                                                <ul class="list-unstyled">
                                                    @foreach ($pemesanan->items as $item)
                                                        <li class="py-2 d-flex align-items-center flex-wrap">
                                                            <img src="{{ asset('images/' . $item->keranjang->barang->gambar_brg) }}"
                                                                alt="{{ $item->keranjang->barang->nama }}"
                                                                class="product-image img-fluid"
                                                                style="height:60px; width: 100px; object-fit: cover;">
                                                            <div class="ms-2">
                                                                <strong>{{ $item->keranjang->barang->nama }}</strong><br>
                                                                <span>x{{ $item->keranjang->jumlah }}</span><br>
                                                                <span>Rp
                                                                    {{ number_format($item->keranjang->barang->harga, 0, ',', '.') }}</span>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                <h5>Detail Pengiriman</h5>
                                                <p><strong>Tempat Pengiriman:</strong>
                                                    {{ $pemesanan->nama_pengiriman }}
                                                </p>
                                                <p><strong>Nama Layanan:</strong> {{ $pemesanan->nama_layanan }}</p>
                                                <p><strong>Berat:</strong> {{ $pemesanan->total_berat }} kg</p>
                                                <p><strong>Harga Layanan:</strong>
                                                    Rp{{ number_format($pemesanan->harga_layanan, 0, ',', '.') }}</p>
                                                @if ($pemesanan->nomor_resi != null)
                                                    <p><strong>Nomor Resi Barang:</strong> {{ $pemesanan->nomor_resi }}
                                                    </p>
                                                @endif
                                            </div>
                                        </details>


                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($pemesanan->tgl_pmsan)->format('d M Y') }}</td>
                                    <td>Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span
                                            class="status {{ $pemesanan->status_brg === 'Sudah sampai' ? 'delivered' : '' }}">
                                            {{ $pemesanan->status_brg }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('invoice.generate', $pemesanan->id_pmsan) }}"
                                            class="invoice-button">Invoice</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('Template BackEnd/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
