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
