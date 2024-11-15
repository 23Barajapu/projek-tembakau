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

    <!-- Libraries Stylesheet -->
    <link href="  Template FrontEnd/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="  Template FrontEnd/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="  Template FrontEnd/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="  Template FrontEnd/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->
    <!-- Menampilkan navbar berdasarkan status login -->
    @auth
        <x-navpengunjung></x-navpengunjung>
    @else
        <x-navtamu></x-navtamu>
    @endauth



    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">100% Original Tembakau</h4>
                    <h1 class="mb-4 display-3 text-primary">Hasil Panen Tembakau</h1>
                    <div class="position-relative mx-auto mb-5">
                        <a href="/shop"
                            class="btn btn-primary border-2 border-secondary py-3 px-4 rounded-pill text-white"
                            style="position: absolute; top: 30%; right: 70%;">Shop Now</a><br><br>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="images/tembakau1.jpeg" class="img-fluid bg-secondary rounded"
                                    style="width: 525px; height: 300px;" alt="First slide">
                            </div>
                            <div class="carousel-item rounded">
                                <img src="images/tembakau2.jpeg" style="width: 525px; height: 300px;"
                                    class="img-fluid rounded" alt="Second slide">
                            </div>
                            <div class="carousel-item rounded">
                                <img src="images/tembakau3.jpeg" style="width: 525px; height: 300px;"
                                    class="img-fluid rounded" alt="Third slide">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Featurs Section Start -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <!-- Kolom Gambar -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="images/tentangKami.jpeg" alt="Tentang Kami" class="img-fluid rounded"
                        style="width: 500px; height: 500px;">
                </div>
                <!-- Kolom Deskripsi -->
                <div class="col-md-6">
                    <h1 class="mb-4">Tentang Kami</h1>
                    <p><b>Ketua Kelompok : </b>Omay Komarudin</p>
                    <p></p>
                    <p>
                        Saat ini di Desa Cimeuhmai memiliki lima kelompok tani tembakau yang aktif, salah satu kelompok
                        tani tembakau berada di Kampung Sukomulyo RT 20 RW 006, kelompok tani ini bernama Caringin.
                    </p>
                    <p>
                        Kelompok tani Caringin dibentuk pada tahun 2018 yang diketuai oleh Bapak Kamarudin. Saat ini
                        kelompok tani Caringin memiliki anggota sebanyak 20 orang petani yang merupakan masyarakat Desa
                        Cimeuhmai. Sampai saat ini ketua dan anggota kelompok tani Caringin bekerjasama dengan baik
                        untuk dapat menghasilkan tembakau yang berkualitas sesuai dengan kebutuhan dari mitra.
                    </p>
                    <p>
                        Tidak hanya itu beberapa anggota tani Caringin terlibat langsung menjadi pengurus pada "Asosiasi
                        Petani Tembakau Indonesia Kanca Subang".
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Featurs Section End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start">
                        <h1>Our Products</h1>
                    </div>
                    <div class="col-lg-8 text-end">
                        <form method="GET" action="{{ route('home.filter') }}">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill {{ request()->get('category_id') === null ? 'active' : '' }}"
                                        href="{{ route('home.filter', ['category_id' => null]) }}">
                                        <span class="text-dark" style="width: 130px;">All Products</span>
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                    <li class="nav-item">
                                        <a class="d-flex m-2 py-2 bg-light rounded-pill {{ request()->get('category_id') == $category->id ? 'active' : '' }}"
                                            href="{{ route('home.filter', ['category_id' => $category->id]) }}">
                                            <span class="text-dark" style="width: 130px;">{{ $category->nama }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @if ($barang->isEmpty())
                                <p>Barang kosong.</p>
                            @else
                                @foreach ($barang as $brg)
                                    <div class="col-md-6 col-lg-4 col-xl-3 d-flex align-items-stretch">
                                        <div
                                            class="rounded position-relative fruite-item flex-fill d-flex flex-column">
                                            <div class="fruite-img">
                                                <img src="{{ asset('images/' . $brg->gambar_brg) }}"
                                                    class="img-fluid w-100 rounded-top" alt="{{ $brg->nama }}"
                                                    style="height: 300px; object-fit: cover;">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">
                                                {{ $brg->kategori->nama }}
                                            </div>
                                            <div
                                                class="p-4 border border-secondary border-top-0 rounded-bottom flex-grow-1 d-flex flex-column">
                                                <h4>{{ $brg->nama }}</h4>
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
                                                        ... <a
                                                            href="{{ route('shop-detail', ['id_brg' => $brg->id_brg]) }}"
                                                            class="text-primary">more details</a>
                                                    @endif
                                                </p>
                                                <div class="d-flex justify-content-between flex-lg-wrap mt-auto">
                                                    <p class="text-dark fs-6 fw-bold mb-0">
                                                        Rp {{ number_format($brg->harga, 0, ',', '.') }} /
                                                        {{ $brg->satuan }}
                                                    </p>

                                                </div>
                                                @auth
                                                    <form action="{{ route('FrontEnd.keranjang') }}" method="POST">
                                                        @csrf
                                                        <div class="position-relative mb-5 py-2">
                                                            <input type="hidden" name="id_brg"
                                                                value="{{ $brg->id_brg }}">
                                                            <!-- Hidden input untuk ID barang -->
                                                            <input type="hidden" name="jumlah" class="jumlah-input"
                                                                value="1">
                                                            <!-- Hidden input untuk jumlah barang yang akan diupdate menggunakan JavaScript -->
                                                            <button type="submit"
                                                                class="btn border border-secondary rounded-pill px-3 text-primary"
                                                                style="position: absolute; left: 0;">
                                                                <i class="fa fa-shopping-bag me-2 text-primary"></i>
                                                                Add to cart
                                                            </button>
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
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="pagination d-flex justify-content-center mt-5">
                                {{ $barang->links() }} <!-- Panggil links() di sini untuk pagination -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->


    <!-- Vesitable Shop Start
    <div class="container-fluid vesitable py-5">
        <div class="container py-5">
            <h1 class="mb-0">Fresh Organic Vegetables</h1><br>
            <div class="owl-carousel vegetable-carousel justify-content-center">
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="  Template FrontEnd/img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top"
                            alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                        style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Parsely</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>

                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="  Template FrontEnd/img/vegetable-item-1.jpg" class="img-fluid w-100 rounded-top"
                            alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                        style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Parsely</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>

                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="  Template FrontEnd/img/vegetable-item-3.png"
                            class="img-fluid w-100 rounded-top bg-light" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                        style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Banana</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>

                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="  Template FrontEnd/img/vegetable-item-4.jpg" class="img-fluid w-100 rounded-top"
                            alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                        style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Bell Papper</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>

                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="  Template FrontEnd/img/vegetable-item-5.jpg" class="img-fluid w-100 rounded-top"
                            alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                        style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Potatoes</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>

                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="  Template FrontEnd/img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top"
                            alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                        style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Parsely</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>

                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="  Template FrontEnd/img/vegetable-item-5.jpg" class="img-fluid w-100 rounded-top"
                            alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                        style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Potatoes</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>

                        </div>
                    </div>
                </div>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="  Template FrontEnd/img/vegetable-item-6.jpg" class="img-fluid w-100 rounded-top"
                            alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                        style="top: 10px; right: 10px;">Vegetable</div>
                    <div class="p-4 rounded-bottom">
                        <h4>Parsely</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    Vesitable Shop End -->

    <!-- Bestsaler Product Start
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">Bestseller Products</h1>
                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which
                    looks reasonable.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="  Template FrontEnd/img/best-product-1.jpg"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="  Template FrontEnd/img/best-product-2.jpg"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="  Template FrontEnd/img/best-product-3.jpg"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="  Template FrontEnd/img/best-product-4.jpg"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="  Template FrontEnd/img/best-product-5.jpg"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="  Template FrontEnd/img/best-product-6.jpg"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="  Template FrontEnd/img/fruite-item-1.jpg" class="img-fluid rounded"
                            alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="  Template FrontEnd/img/fruite-item-2.jpg" class="img-fluid rounded"
                            alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="  Template FrontEnd/img/fruite-item-3.jpg" class="img-fluid rounded"
                            alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="  Template FrontEnd/img/fruite-item-4.jpg" class="img-fluid rounded"
                            alt="">
                        <div class="py-2">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    Bestsaler Product End -->


    <x-footer></x-footer>
    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>
                        </a>Politeknik Negeri Subang, All right reserved.</span>
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

    <script src="  Template FrontEnd/lib/easing/easing.min.js"></script>
    <script src="  Template FrontEnd/lib/waypoints/waypoints.min.js"></script>
    <script src="  Template FrontEnd/lib/lightbox/js/lightbox.min.js"></script>
    <script src="  Template FrontEnd/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="  Template FrontEnd/js/main.js"></script>
</body>

</html>
