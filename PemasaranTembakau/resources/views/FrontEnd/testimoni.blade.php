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
    <style>
        /* Styling untuk rating bintang */
        .stars {
            display: flex;
            justify-content: flex-start;
        }

        .stars input[type="radio"] {
            display: none;
        }

        .stars label {
            font-size: 1.5rem;
            color: gray;
            cursor: pointer;
            transition: color 0.2s;
        }

        .stars input[type="radio"]:checked~label {
            color: gold;
        }

        .stars .filled {
            color: #f5c518;
            /* Bright yellow for filled stars */
        }

        .stars .empty {
            color: #e0e0e0;
            /* Dark grey for empty stars */
        }

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

        .star-rating-complete {
            color: #c59b08;
        }

        .rating-container .form-control:hover,
        .rating-container .form-control:focus {
            background: #fff;
            border: 1px solid #ced4da;
        }

        .rating-container textarea:focus,
        .rating-container input:focus {
            color: #000;
        }

        .rated {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rated:not(:checked)>input {
            position: absolute;
            display: none;
        }

        .rated:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 30px;
            color: #ffc700;
        }

        .rated:not(:checked)>label:before {
            content: '★ ';
        }

        .rated>input:checked~label {
            color: #ffc700;
        }

        .rated:not(:checked)>label:hover,
        .rated:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rated>input:checked+label:hover,
        .rated>input:checked+label:hover~label,
        .rated>input:checked~label:hover,
        .rated>input:checked~label:hover~label,
        .rated>label:hover~input:checked~label {
            color: #c59b08;
        }

        /* Star yang sudah diisi */
        .filled {
            color: #FFD700;
            font-size: 20px;
        }

        /* Star yang kosong */
        .empty {
            color: #ccc;
            font-size: 20px;
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

    <main>
        <!-- Featurs Section Start -->
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Testimoni Hasil Panen Tembakau</h2>
                <p class="text-secondary">Apa kata para pembeli tentang hasil panen tembakau kami</p>
            </div>


            <!-- Testimoni 1 -->
            <div class="row">
                @foreach ($reviews as $index => $review)
                    <div class="col-md-4 review-card @if ($index >= 9) d-none @endif">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="mb-0">{{ $review->user->name }}</h5>
                                <div class="stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->star_rating)
                                            <label class="filled">&#9733;</label> <!-- Star Filled -->
                                        @else
                                            <label class="empty">&#9734;</label> <!-- Star Empty -->
                                        @endif
                                    @endfor
                                </div>
                                <p class="mt-3">"{{ $review->comments }}"</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol 'Selengkapnya' akan tampil jika ada lebih dari 9 testimoni -->
            @if ($totalReviews > 9)
                <div class="text-center mt-4">
                    <button id="show-more-reviews" class="btn btn-primary">Selengkapnya</button>
                </div>
            @endif

            <!-- Script untuk menampilkan semua review saat tombol diklik -->
            <script>
                document.getElementById('show-more-reviews').addEventListener('click', function() {
                    // Tampilkan semua card yang disembunyikan
                    document.querySelectorAll('.review-card.d-none').forEach(function(card) {
                        card.classList.remove('d-none');
                    });

                    // Sembunyikan tombol setelah semua review tampil
                    this.style.display = 'none';
                });
            </script>




            <!-- Form Testimoni Baru -->
            @auth
                <div class="mt-5">
                    <h3 class="fw-bold">Buat Testimoni Baru</h3>
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf <!-- Token CSRF penting untuk keamanan -->
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div class="rate">
                                <input type="radio" id="star5" class="rate" name="rating" value="5" />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" checked id="star4" class="rate" name="rating"
                                    value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" class="rate" name="rating" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" class="rate" name="rating" value="2">
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" class="rate" name="rating" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="testimoni" class="form-label">Testimoni</label>
                            <textarea class="form-control" name="comment" id="testimoni" rows="4" placeholder="Tuliskan testimoni Anda"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Testimoni</button>
                    </form>

                </div>
            @else
                <div></div>
            @endauth

    </main>

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
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed
                    By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
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
