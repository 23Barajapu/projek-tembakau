<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Register</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="Template BackEnd/assets/img/favicon.png" rel="icon">
    <link href="Template BackEnd/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="Template BackEnd/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Template BackEnd/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="Template BackEnd/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="Template BackEnd/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="Template BackEnd/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="Template BackEnd/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="Template BackEnd/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="Template BackEnd/assets/css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #dff6b5
        }
    </style>
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
                                        <h5 class="card-title text-center pb-0 fs-4" style="color: #81c408">Create an
                                            Account</h5>
                                        <p class="text-center small">Tolong masukkan data tentang anda untuk membuat
                                            sebuah akun</p>
                                    </div>
                                    @error('password')
                                        <div class="text-red-600 alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <br>
                                    <form class="row g-3 needs-validation" novalidate method="POST"
                                        action="{{ route('register') }}">
                                        @csrf

                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control" id="yourName"
                                                required>
                                            <div class="invalid-feedback">Tolong, masukkan nama lengkap kamu!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" name="email" class="form-control" id="yourEmail"
                                                    required>
                                                <div class="invalid-feedback">Tolong, masukkan alamat email kamu!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourAddress" class="form-label">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" id="yourAddress"
                                                required>
                                            <div class="invalid-feedback">Tolong, masukkan alamat kamu!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourAddress" class="form-label">Kota</label>
                                            <input type="text" name="kota" class="form-control" id="yourCity"
                                                pattern="^[A-Z][a-z]*(\s[A-Z][a-z]*)*$"
                                                title="Kota harus diawali dengan huruf kapital di setiap kata (misalnya: 'Bandung Barat')"
                                                required>
                                            <div class="invalid-feedback">Tolong, masukkan kota kamu dengan benar
                                                menggunakan awalan kapital!</div>
                                        </div>


                                        <div class="col-12">
                                            <label for="yourPhoneNumber" class="form-label">Nomor Handphone (Aktif
                                                WhatsApp)</label>
                                            <input type="text" name="telepon" class="form-control"
                                                id="yourPhoneNumber" required>
                                            <div class="invalid-feedback">Tolong, masukkan nomor handphone kamu!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Tolong, masukkan password kamu!</div>
                                        </div>

                                        <div class="col-12">
                                            <hr>
                                            <button class="btn btn-primary border-2 text-white w-100"
                                                style="border-color: #ffb524; background-color: #81c408;"
                                                type="submit">Create Account</button>
                                        </div>

                                        <div class="col-12">
                                            <p class="small mb-0">Apakah sudah mempunyai akun? <a href="/login"
                                                    style="color: #ffb524;">Log in</a></p>
                                        </div>
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
    <script src="Template BackEnd/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="Template BackEnd/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="Template BackEnd/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="Template BackEnd/assets/vendor/echarts/echarts.min.js"></script>
    <script src="Template BackEnd/assets/vendor/quill/quill.js"></script>
    <script src="Template BackEnd/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="Template BackEnd/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="Template BackEnd/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="Template BackEnd/assets/js/main.js"></script>

</body>

</html>
