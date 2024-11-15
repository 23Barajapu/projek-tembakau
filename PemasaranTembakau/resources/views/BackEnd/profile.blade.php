<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Profil Pengguna</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('Template BackEnd/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('Template BackEnd/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Nunito|Poppins" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('Template BackEnd/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('Template BackEnd/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <style>
        /* Additional styles for profile card */
        .profile-card {
            max-width: 500px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-card .profile-header {
            background-color: var(--color-secondary);
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }

        .profile-card .profile-header h2 {
            margin: 0;
        }

        .profile-card .profile-body {
            padding: 20px;
            background-color: #fff;
            border-radius: 0 0 8px 8px;
        }

        .profile-card .profile-body .info {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .profile-card .profile-body .info i {
            font-size: 18px;
            color: var(--color-primary);
            /* Menggunakan variabel CSS */
            width: 30px;
        }


        .profile-card .profile-body .info span {
            margin-left: 10px;
            color: #333;
        }
    </style>

    <!-- Template Main CSS File -->
    <link href="{{ asset('Template BackEnd/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <x-NavAdmin></x-NavAdmin>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profil Pengguna</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Profil Pengguna</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="card profile-card">
                            <!-- Header Section -->
                            <div class="card-title profile-header">
                                <h2>Profile Admin</h2>
                            </div>
                            <hr>

                            <!-- Profile Information Section -->
                            <div class="profile-body">
                                <div class="info">
                                    <i class="bi bi-person"></i>
                                    <span><strong>Nama:</strong> {{ $user->name }}</span>
                                </div>
                                <div class="info">
                                    <i class="bi bi-envelope"></i>
                                    <span><strong>Email:</strong> {{ $user->email }}</span>
                                </div>
                                <div class="info">
                                    <i class="bi bi-house-door"></i>
                                    <span><strong>Alamat:</strong> {{ $user->alamat }}</span>
                                </div>
                                <div class="info">
                                    <i class="bi bi-geo-alt"></i>
                                    <span><strong>Kota:</strong> {{ $user->kota }}</span>
                                </div>
                                <div class="info">
                                    <i class="bi bi-telephone"></i>
                                    <span><strong>Telepon:</strong> {{ $user->telepon }}</span>
                                </div>
                                <a href="{{ route('admin_profile.edit') }}" class="btn btn-primary w-100">Edit
                                    Profil</a>

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
    <script src="{{ asset('Template BackEnd/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Template BackEnd/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('Template BackEnd/assets/js/main.js') }}"></script>
</body>

</html>
