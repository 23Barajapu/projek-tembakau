<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Daftar Barang</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('Template BackEnd/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('Template BackEnd/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor css Files -->
    <link href="{{ asset('Template BackEnd/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <style>
        .icon-link i {
            font-size: 18px;
        }

        /* Responsive table */
        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }

            td,
            th {
                padding: 8px;
            }
        }

        @media (max-width: 576px) {
            .breadcrumb {
                font-size: 12px;
            }

            h1 {
                font-size: 18px;
            }

            .btn {
                padding: 5px 10px;
                font-size: 14px;
            }

            .icon-link i {
                font-size: 16px;
            }
        }
    </style>
    <!-- Template BackEnd Main css File -->
    <link href="{{ asset('Template BackEnd/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <x-NavAdmin></x-NavAdmin>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Kategori Barang</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/kategori">Kategori Barang</a></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="card info-card sales-card">
                            <div class="container"><br>
                                <form action="{{ route('kategori.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama">Nama Kategori</label>
                                        <input type="text" name="nama" class="form-control"
                                            value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('Template BackEnd/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Template BackEnd Main JS File -->
    <script src="{{ asset('Template BackEnd/assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
