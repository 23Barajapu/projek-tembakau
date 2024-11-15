<?php
include "koneksi.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="Template/assets/img/favicon.png" rel="icon">
    <link href="Template/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="Template/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Template/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="Template/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="Template/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="Template/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="Template/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="Template/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="Template/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <?php
    include "navbar.php";
    ?>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data Tembakau</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Data Tembakau</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="main-panel">
                <div class="mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3><b>Tambah Tembakau</b></h3>
                        </div>
                        <div class="card-body">
                            <br>
                            <form class="row g-3">
                                <div class="col-12">
                                    <label for="nama_tembakau" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="inputNanme4" required>
                                </div>
                                <div class="col-12">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="text" class="form-control" id="inputNanme4" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="stok" class="form-label">Stok</label>
                                    <input type="text" class="form-control" id="inputAddress" required>
                                </div>
                                <div class="col-md-2">
                                    <label for="nama_tembakau" class="form-label">Satuan</label>
                                    <select id="inputState" class="form-select" required>
                                        <option selected>Kg</option>
                                        <option>Ton</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="gambar_panen" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="gambar_panen" name="gambar_panen" accept=".jpg, .jpeg, .png" required>
                                </div>
                                <div class="col-12">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <input type="text" class="form-control" id="inputAddress" required>
                                </div>
                                <div class="text">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- Vertical Form -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="Template/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="Template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="Template/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="Template/assets/vendor/echarts/echarts.min.js"></script>
    <script src="Template/assets/vendor/quill/quill.js"></script>
    <script src="Template/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="Template/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="Template/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="Template/assets/js/main.js"></script>

</body>

</html>