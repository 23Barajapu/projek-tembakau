<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Konfirmasi Penjualan Tembakau</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="Template FrontEnd/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="Template FrontEnd/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="Template FrontEnd/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="Template FrontEnd/css/style.css" rel="stylesheet">

    <style>
        .border-bottom-custom {
            border-bottom: 1px solid #bab4b4;
            /* Defines the border style and color */
            width: 50%;
        }

        .border-bottom-custom-normal {
            border-bottom: 1px solid #bab4b4;
            /* Defines the border style and color */
            width: 100%;
        }
    </style>
    <style>
        .divScroll {
            overflow-x: auto;
            /* Enables horizontal scrolling */
            height: 500px;
            /* Sets a fixed height for scrolling */
        }

        .table-responsive {
            overflow-x: auto;
            /* Enables horizontal scrolling on smaller screens */
        }

        table {
            width: 100%;
            /* Full width */
            border-collapse: collapse;
            table-layout: auto;
            /* Allows the table to auto adjust */
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        .status {
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .delivered {
            background-color: #4CAF50;
            /* Green */
        }

        .product-image {
            width: 6rem;
            height: 3.5rem;
            object-fit: cover;
            margin-right: 10px;
        }

        .invoice-button {
            background-color: #6f42c1;
            /* Purple */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .sudah-button {
            background-color: #4CAF50;
            /* Purple */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .invoice-button:hover {
            background-color: #5a32a1;
            /* Darker purple */
        }
    </style>
</head>

<body>



    <x-navpengunjung></x-navpengunjung>


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Status Pemesanan</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Status Pemesanan</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <div class="container">
        <h2 class="mt-4 py-4">Status Pemesanan</h2>
        @if ($pemesanans->isEmpty())
            <div class="alert alert-warning">
                <strong>Peringatan!</strong> Tidak ada pemesanan di status.
            </div>
        @else
            <div class="table-responsive divScroll">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light ">
                        <tr>
                            <th>ID Pemesanan</th>
                            <th>Barang</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Harga Pengiriman</th>
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
                                    <ul class="list-unstyled">
                                        @foreach ($pemesanan->items as $item)
                                            <li class="py-2 d-flex align-items-center flex-wrap">
                                                <img src="{{ asset('images/' . $item->keranjang->barang->gambar_brg) }}"
                                                    alt="{{ $item->keranjang->barang->nama }}"
                                                    class="product-image img-fluid">
                                                <div class="ms-2">
                                                    <strong>{{ $item->keranjang->barang->nama }}</strong><br>
                                                    <span>x{{ $item->keranjang->jumlah }}</span><br>
                                                    <span>Rp{{ number_format($item->keranjang->barang->harga, 0, ',', '.') }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($pemesanan->tgl_pmsan)->format('d F Y') }}</td>
                                <td>{{ $pemesanan->nama_pengiriman }} - {{ $pemesanan->nama_layanan }} dengan harga
                                    Rp{{ number_format($pemesanan->harga_layanan, 0, ',', '.') }}
                                    <hr>
                                    @if ($pemesanan->status_brg === 'Pengiriman' || $pemesanan->status_brg === 'Sudah Sampai')
                                        <p>No Resi Barang:
                                            <strong>
                                                {{ $pemesanan->nomor_resi ?? 'Nomor Resi belum tersedia, silakan hubungi penjual' }}
                                            </strong>
                                        </p>
                                        <img src="{{ asset('gambar_resi/' . $pemesanan->gambar_resi) }}"
                                            alt="{{ $pemesanan->nomor_resi }}" width="300" class="img-fluid">
                                    @endif
                                </td>
                                <td>Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="status delivered">
                                        {{ $pemesanan->status_brg }}
                                    </span>

                                </td>
                                <td>
                                    <a href="{{ route('invoice.generate', $pemesanan->id_pmsan) }}"
                                        class="invoice-button">Invoice</a><br>
                                    @if ($pemesanan->status_brg === 'Pengiriman')
                                        <form action="{{ route('update-statusSS', $pemesanan->id_pmsan) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT') <!-- Gunakan PUT untuk mengupdate data -->
                                            <button type="submit" class="sudah-button mt-3">
                                                Barang sudah sampai?
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script src="Template FrontEnd/js/bootstrap.bundle.min.js"></script>


    <!-- Footer Start -->
    <x-footer></x-footer>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your
                            Site Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                        class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="Template FrontEnd/lib/easing/easing.min.js"></script>
    <script src="Template FrontEnd/lib/waypoints/waypoints.min.js"></script>
    <script src="Template FrontEnd/lib/lightbox/js/lightbox.min.js"></script>
    <script src="Template FrontEnd/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="Template FrontEnd/js/main.js"></script>
</body>

</html>
