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
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

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
</head>

<body>



    <x-navpengunjung></x-navpengunjung>


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <div class="container py-5">
        <h1 class="mb-4 py-3 border-bottom-custom-normal">Konfirmasi Pembayaran</h1>

        <h4 class="border-bottom-custom py-2">Data Pembeli</h4>
        <p>Nama: {{ $validatedData['nama'] }}</p>
        <input type="hidden" name="nama" value="{{ $validatedData['nama'] }}">

        <p>Alamat: {{ $validatedData['alamat'] }}</p>
        <input type="hidden" name="alamat" value="{{ $validatedData['alamat'] }}">

        <p>Telepon: {{ $validatedData['telepon'] }}</p>
        <input type="hidden" name="telepon" value="{{ $validatedData['telepon'] }}">

        <p>Catatan: {{ $validatedData['catatan'] }}</p>
        <input type="hidden" name="catatan" value="{{ $validatedData['catatan'] }}">

        <div class="border-top py-2"></div>
        <h4 class="border-bottom-custom py-2">Data Pengiriman</h4>
        <p>Nama Pengiriman: {{ $validatedData['nama_pengiriman'] }}</p>
        <input type="hidden" name="nama_pengiriman" value="{{ $validatedData['nama_pengiriman'] }}">

        <p>Nama Layanan: {{ $validatedData['nama_layanan'] }}</p>
        <input type="hidden" name="nama_layanan" value="{{ $validatedData['nama_layanan'] }}">

        <p>Harga Layanan: {{ $validatedData['harga_layanan'] }}</p>
        <input type="hidden" name="telepon" value="{{ $validatedData['harga_layanan'] }}">

        <p>Total Berat Barang: {{ $validatedData['berat'] }} Kg</p>
        <input type="hidden" name="berat" value="{{ $validatedData['berat'] }}">
        <div class="border-top py-2"></div>
        <h4 class="border-bottom-custom py-2">Detail Pembelian</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Products</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($keranjangs as $item)
                    @if (isset($item['barang']))
                        <tr>
                            <td>
                                <img src="{{ asset('images/' . $item['barang']['gambar_brg']) }}" class="img-fluid"
                                    style="width: 80px;" alt="{{ $item['barang']['nama'] }}">
                            </td>
                            <td>{{ $item['barang']['nama'] }}</td>
                            <td>Rp{{ number_format($item['barang']['harga'], 0, ',', '.') }}</td>
                            <td>{{ $item['jumlah'] }}</td>
                            <td>Rp{{ number_format($item['sub_total'], 0, ',', '.') }}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Harga Pengiriman: </td>
                    <td>Rp{{ number_format($validatedData['harga_layanan'], 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><strong>TOTAL</strong></td>
                    <td><strong>Rp{{ number_format($total, 0, ',', '.') }}</strong></td>
                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="keranjangs" value="{{ json_encode($keranjangs) }}">
                    <!-- Ubah menjadi json_encode untuk menghindari error -->
                </tr>
            </tbody>
        </table>

        <div class="align-items-center justify-content-center pt-4">
            <button type="submit" id="pay-button" class="btn border-secondary py-3 px-4 text-uppercase text-primary">
                Complete Payment
            </button>
            <script type="text/javascript">
                var payButton = document.getElementById('pay-button');
                payButton.addEventListener('click', function() {
                    window.snap.pay('{{ $snapToken }}', {
                        onSuccess: function(result) {
                            // Redirect to /payment/success with orderId as a query parameter
                            window.location.href = '/payment/success?orderId={{ $orderId }}';
                        },
                        onPending: function(result) {
                            alert("Menunggu pembayaran Anda!");
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal!");
                        }
                    });
                });
            </script>

        </div>

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
