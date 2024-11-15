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
            <h1>Barang Panen</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Barang Panen</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <div class="card info-card sales-card">
                            <div class="container"><br>

                                <!-- Category Filter -->
                                <div class="mb-3">
                                    <!-- Blade Template -->
                                    <form method="GET" action="{{ route('barang_panen.filter') }}">
                                        <div class="btn-group">
                                            <button class="btn btn-primary bg-light me-2 text-primary rounded-pill">
                                                <a href="{{ route('barang_panen.create') }}" type="button"
                                                    class="icon-link"><i class="bx bxs-book-add py-2"></i>Tambah</a>
                                            </button>
                                            <button type="button"
                                                class="btn btn-primary dropdown-toggle bg-light me-2 text-primary rounded-pill"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Filter by Category
                                            </button>
                                            <ul class="dropdown-menu">
                                                <!-- All Categories Item -->
                                                <li>
                                                    <a class="dropdown-item {{ request()->get('category_id') === '' ? 'active' : '' }}"
                                                        href="{{ route('barang_panen.filter', ['category_id' => '']) }}">
                                                        All Categories
                                                    </a>
                                                </li>
                                                <!-- Category Items -->
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <a class="dropdown-item {{ request()->get('category_id') == $category->id ? 'active' : '' }}"
                                                            href="{{ route('barang_panen.filter', ['category_id' => $category->id]) }}">
                                                            {{ $category->nama }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </form>
                                </div>

                                @if (session('success'))
                                    <div class="alert alert-success py-3">{{ session('success') }}</div>
                                @endif

                                @if ($barang->isEmpty())
                                    <div class="alert alert-warning mt-3">
                                        <strong>Peringatan!</strong> Tidak ada barang di data barang.
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table mt-3">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>Harga</th>
                                                    <th>Stok</th>
                                                    <th>Satuan</th>
                                                    <th>Deskripsi</th>
                                                    <th>Gambar</th>
                                                    <th>Kategori</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($barang as $brg)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $brg->id_brg }}</td>
                                                        <td>{{ $brg->nama }}</td>
                                                        <td>Rp {{ number_format($brg->harga, 0, ',', '.') }}</td>
                                                        <td>{{ $brg->stok }}</td>
                                                        <td>{{ $brg->satuan }}</td>
                                                        <td>{!! nl2br(e($brg->deskripsi)) !!}</td>
                                                        <td>
                                                            @if ($brg->gambar_brg)
                                                                <img src="{{ asset('images/' . $brg->gambar_brg) }}"
                                                                    alt="{{ $brg->nama }}" width="300"
                                                                    class="img-fluid">
                                                            @else
                                                                <p>No Image</p>
                                                            @endif
                                                        </td>
                                                        <td>{{ $brg->kategori->nama }}</td>
                                                        <td>
                                                            <a href="{{ route('barang_panen.edit', $brg->id_brg) }}"
                                                                class="btn btn-warning mb-2 rounded-pill">
                                                                <i class="bi bi-pencil-fill"></i>Edit
                                                            </a>
                                                            <br>
                                                            <form
                                                                action="{{ route('barang_panen.destroy', $brg->id_brg) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger rounded-pill "><i
                                                                        class="bx bxs-trash ">Hapus</i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
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
