<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href=" Template BackEnd/assets/img/favicon.png" rel="icon">
    <link href=" Template BackEnd/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
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
    <!-- Vendor CSS Files -->
    <link href=" Template BackEnd/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href=" Template BackEnd/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href=" Template BackEnd/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href=" Template BackEnd/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href=" Template BackEnd/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href=" Template BackEnd/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href=" Template BackEnd/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href=" Template BackEnd/assets/css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #dff6b5
        }
    </style>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4" style="color:  #81c408">Login to
                                            Your Account</h5>
                                        <p class="text-center small">Silakan masukkan email dan password untuk melakukan
                                            login</p>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <p>{{ $error }}</p>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <form action="/login" method="POST" class="row g-3 needs-validation" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="email" class="form-control" id="email"
                                                    value="{{ old('email') }}" required>
                                                <div class="invalid-feedback">Tolong, masukkan email anda!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Tolong, masukkan password anda!</div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                            <button class="btn btn-primary border-2 text-white w-100"
                                                style="border-color: #ffb524; background-color: #81c408;"
                                                type="submit">Login</button>

                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Tidak mempunyai akun? <a href="/register"
                                                    style="color: #ffb524;">Buat
                                                    akun</a></p>
                                        </div>
                                        {{-- <div class="col-12">
                                            <p class="small">Lupa Password? <a href="/forgot-password"
                                                    style="color: #ffb524;">Reset</a></p>
                                        </div> --}}
                                    </form>
                                </div>
                            </div>
                            <div class="credits">
                                Designed by <a href="https://bootstrapmade.com/"
                                    style="color: #ffb524;">BootstrapMade</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src=" Template BackEnd/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src=" Template BackEnd/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src=" Template BackEnd/assets/vendor/chart.js/chart.umd.js"></script>
    <script src=" Template BackEnd/assets/vendor/echarts/echarts.min.js"></script>
    <script src=" Template BackEnd/assets/vendor/quill/quill.js"></script>
    <script src=" Template BackEnd/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src=" Template BackEnd/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src=" Template BackEnd/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src=" Template BackEnd/assets/js/main.js"></script>
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="  Template FrontEnd/lib/easing/easing.min.js"></script>
    <script src="  Template FrontEnd/lib/waypoints/waypoints.min.js"></script>
    <script src="  Template FrontEnd/lib/lightbox/js/lightbox.min.js"></script>
    <script src="  Template FrontEnd/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="  Template FrontEnd/js/main.js"></script>

</body>

</html>
