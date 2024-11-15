<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Penjualan Tembakau</title>
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

    <!-- Template FrontEnd/libraries Stylesheet -->
    <link href="{{ asset('Template FrontEnd/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Template FrontEnd/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('Template FrontEnd/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('Template FrontEnd/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.5.2/css/ionicons.min.css">
    <style>
        .img-fluid {
            width: 100%;
            /* Gambar responsif */
            height: auto;
            /* Memastikan proporsi gambar terjaga */
            object-fit: cover;
            /* Memastikan gambar menutupi area kontainer */
        }

        .image-container {
            height: 300px;
            /* Set tinggi tetap untuk gambar */
            overflow: hidden;
            /* Menghindari gambar melampaui kontainer */
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->
    <!-- Menampilkan navbar berdasarkan status login -->
    <x-navpengunjung></x-navpengunjung>

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div><br><br>
    <!-- Single Page Header End -->

    <!-- Fruits Shop Start-->
    <section class="ftco-section">
        <div class="container">
            @csrf
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ asset('images/' . $barang->gambar_brg) }}" class="image-popup">
                        <img src="{{ asset('images/' . $barang->gambar_brg) }}" class="img-fluid rounded shadow"
                            alt="{{ $barang->nama }}" style="width: 500px; height: 500px;">
                    </a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ $barang->nama }}</h3>
                    <p class="price">Rp {{ number_format($barang->harga, 0, ',', '.') }}</p>
                    <p>{!! nl2br(e($barang->deskripsi)) !!}</p>
                    <div class="row mt-4">
                        <div class="input-group col-md-6 d-flex mb-3 quantity-buttons">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="btn btn-primary quantity-left-minus" data-type="minus">
                                    <i class="bi bi-dash"></i>
                                </button>
                            </span>
                            <input type="text" class="form-control input-number" value="1" min="1"
                                max="{{ $barang->stok }}" data-stock="{{ $barang->stok }}">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="btn btn-primary quantity-right-plus" data-type="plus">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <p style="color: #000;">{{ $barang->stok }} {{ $barang->satuan }} available</p>
                        </div>
                    </div>
                    <form action="{{ route('FrontEnd.keranjang') }}" method="POST">
                        @csrf
                        <div class="position-relative mx-auto mb-5">

                            <input type="hidden" name="id_brg" value="{{ $barang->id_brg }}">
                            <!-- Hidden input untuk ID barang -->
                            <input type="hidden" name="jumlah" class="jumlah-input" value="1">
                            <!-- Hidden input untuk jumlah barang yang akan diupdate menggunakan JavaScript -->
                            <button type="submit"
                                class="btn btn-primary border-2 border-secondary py-3 px-4 rounded-pill text-white"
                                style="position: relative; left: 0;">Add to Cart</button>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var quantityInput = document.querySelector('.input-number');
                                var hiddenJumlahInput = document.querySelector('.jumlah-input');
                                var plusButton = document.querySelector('.quantity-right-plus');
                                var minusButton = document.querySelector('.quantity-left-minus');

                                plusButton.addEventListener('click', function(e) {
                                    var currentValue = parseInt(quantityInput.value);
                                    var maxValue = parseInt(quantityInput.getAttribute('max'));
                                    if (currentValue < maxValue) {
                                        quantityInput.value = currentValue + 1;
                                    }
                                    hiddenJumlahInput.value = quantityInput.value; // Update hidden input value
                                });

                                minusButton.addEventListener('click', function(e) {
                                    var currentValue = parseInt(quantityInput.value);
                                    if (currentValue > 1) {
                                        quantityInput.value = currentValue - 1;
                                    }
                                    hiddenJumlahInput.value = quantityInput.value; // Update hidden input value
                                });

                                // Update hidden input when user manually changes the value
                                quantityInput.addEventListener('input', function(e) {
                                    hiddenJumlahInput.value = quantityInput.value;
                                });
                            });
                        </script>
                    </form>

                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Fruits Shop detail End-->

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

    <!-- JavaScript Template FrontEnd/libraries -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Template FrontEnd/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('Template FrontEnd/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('Template FrontEnd/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('Template FrontEnd/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!--  Javascript -->
    <script src="{{ asset('Template FrontEnd/js/main.js') }}"></script>
</body>

</html>
