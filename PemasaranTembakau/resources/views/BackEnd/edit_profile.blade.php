<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Profil</title>
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
        .edit-profile-card {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .edit-profile-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>

    <!-- Template Main CSS File -->
    <link href="{{ asset('Template BackEnd/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <x-NavAdmin></x-NavAdmin>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Profil</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Edit Profil</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile-edit">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8">
                        <div class="card edit-profile-card">
                            <h2 class="breadcrumb-item active">Edit Profil Pengguna</h2>
                            <form action="{{ route('admin_profile.update') }}" method="POST">
                                @csrf

                                <!-- Nama -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $user->name) }}" required>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $user->email) }}" required>
                                </div>

                                <!-- Alamat -->
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        value="{{ old('alamat', $user->alamat) }}" required>
                                </div>

                                <!-- Kota -->
                                <div class="mb-3">
                                    <label for="kota" class="form-label">Kota</label>
                                    <input type="text" class="form-control" id="kota" name="kota"
                                        value="{{ old('kota', $user->kota) }}" required>
                                </div>

                                <!-- Telepon -->
                                <div class="mb-3">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="telepon" name="telepon"
                                        value="{{ old('telepon', $user->telepon) }}" required>
                                </div>

                                <!-- Tombol Simpan -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="/admin/profile" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
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
