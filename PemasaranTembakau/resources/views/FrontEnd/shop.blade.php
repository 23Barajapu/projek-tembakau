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
    <link href="Template FrontEnd/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="Template FrontEnd/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="Template FrontEnd/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="Template FrontEnd/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <!-- Spinner End -->
    <!-- Menampilkan navbar berdasarkan status login -->
    <x-navpengunjung></x-navpengunjung>
    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh Tobacco shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <form action="{{ route('shop.index') }}" method="GET" class="w-100 mx-auto d-flex">
                                <input type="search" name="search" class="form-control p-3" placeholder="Search"
                                    value="{{ request()->get('search') }}" aria-describedby="search-icon-1">
                                <button type="submit" class="btn btn-primary fa fa-search"></button>
                            </form>
                        </div>
                        <div class="col-6"></div>

                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <br>
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a href="{{ route('shop.index', ['category_id' => null]) }}"
                                                        class="{{ request()->get('category_id') === null ? 'active' : '' }}">
                                                        <i class="fas fa-seedling me-2"></i>All Products
                                                    </a>
                                                    <span>({{ $totalProducts }})</span> <!-- Total semua produk -->
                                                </div>
                                            </li>
                                            @foreach ($categories as $category)
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="{{ route('shop.index', ['category_id' => $category->id]) }}"
                                                            class="{{ request()->get('category_id') == $category->id ? 'active' : '' }}">
                                                            <i class="fas fa-seedling me-2"></i>{{ $category->nama }}
                                                        </a>
                                                        <span>({{ $category->barang_panen_count }})</span>
                                                        <!-- Jumlah produk per kategori -->
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4 class="mb-4">Filter by Price</h4>
                                        <form action="{{ route('shop.index') }}" method="GET"
                                            class="bg-light p-4 rounded shadow-sm">
                                            <div class="d-flex flex-column">
                                                <label for="min_price" class="mb-1">Minimum Price (Rp)</label>
                                                <input type="number" name="min_price" id="min_price"
                                                    value="{{ $minPrice }}" class="form-control mb-3"
                                                    min="10000" max="1000000" placeholder="Min Price" required>

                                                <label for="max_price" class="mb-1">Maximum Price (Rp)</label>
                                                <input type="number" name="max_price" id="max_price"
                                                    value="{{ $maxPrice }}" class="form-control mb-3"
                                                    min="10000" max="1000000" placeholder="Max Price" required>

                                                <button type="submit" class="btn btn-primary mt-3">Apply
                                                    Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 ">
                                @if ($barang->isEmpty())
                                    <p class="text-center">The item you are looking for is not available.</p>
                                @else
                                    @foreach ($barang as $brg)
                                        <div class="col-md-6 col-lg-4 col-xl-4 d-flex align-items-stretch">
                                            <div
                                                class="rounded position-relative fruite-item flex-fill d-flex flex-column">
                                                <div class="fruite-img">
                                                    <img src="{{ asset('images/' . $brg->gambar_brg) }}"
                                                        class="img-fluid w-100 rounded-top" alt="{{ $brg->nama }}"
                                                        style="object-fit: cover; height: 250px;">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                    style="top: 10px; left: 10px;">
                                                    {{ $brg->kategori->nama }}
                                                </div>
                                                <div
                                                    class="p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1 d-flex flex-column">
                                                    <h4 class="text-truncate" title="{{ $brg->nama }}">
                                                        {{ $brg->nama }}
                                                    </h4>
                                                    <p class="mb-2">
                                                        @php
                                                            $maxWords = 10;
                                                            $wordsArray = explode(' ', strip_tags($brg->deskripsi));
                                                            $deskripsi = implode(
                                                                ' ',
                                                                array_slice($wordsArray, 0, $maxWords),
                                                            );
                                                        @endphp
                                                        {{ $deskripsi }}
                                                        @if (count($wordsArray) > 0)
                                                            <a href="{{ route('shop-detail', ['id_brg' => $brg->id_brg]) }}"
                                                                class="text-primary">more details</a>
                                                        @endif

                                                    </p>
                                                    <div class="d-flex align-items-center flex-lg-wrap mt-auto"
                                                        style="min-height: 70px;">
                                                        <p class="text-dark fs-6 fw-bold mb-0 me-2">Rp
                                                            {{ number_format($brg->harga, 0, ',', '.') }} /
                                                            {{ $brg->satuan }}
                                                        </p>
                                                    </div>
                                                    <form action="{{ route('FrontEnd.keranjang') }}" method="POST">
                                                        @csrf
                                                        <div class="position-relative mx-auto mb-2">

                                                            <input type="hidden" name="id_brg"
                                                                value="{{ $brg->id_brg }}">
                                                            <!-- Hidden input untuk ID barang -->
                                                            <input type="hidden" name="jumlah" class="jumlah-input"
                                                                value="1">
                                                            <!-- Hidden input untuk jumlah barang yang akan diupdate menggunakan JavaScript -->
                                                            <button type="submit"
                                                                class="btn border border-secondary rounded-pill text-primary">
                                                                <i class="fa fa-shopping-bag text-primary"></i>
                                                                Add to
                                                                cart</button>
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
                                    @endforeach
                                @endif

                                <div class="col-12">
                                    <div class="pagination d-flex justify-content-center mt-5">
                                        {{ $barang->appends(request()->except('page'))->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->


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


    <!-- JavaScript Template FrontEnd/libraries -->
    <script src="https://ajax.googleapis.com/ajax/Template FrontEnd/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="Template FrontEnd/lib/easing/easing.min.js"></script>
    <script src="Template FrontEnd/lib/waypoints/waypoints.min.js"></script>
    <script src="Template FrontEnd/lib/lightbox/js/lightbox.min.js"></script>
    <script src="Template FrontEnd/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="Template FrontEnd/js/main.js"></script>
</body>

</html>
