@extends('components.template')
@section('title')
    Anggota Tani
@endsection
@section('pages')
    Anggota Tani
@endsection
@section('title-pages')
    Anggota Tani
@endsection
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .form-control {
            border: 1px solid #ccc;
            border-radius: 0.50rem;
            padding-left: 1rem;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        h4 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .container {
            margin-top: 20px;
        }
    </style>
    <div class="container">
        <!-- Tombol Back dengan Ikon Saja -->
        <div class="d-flex align-items-center">
            <!-- Tombol Back dengan Ikon Saja -->
            <button onclick="goBack()" class="btn btn-lg p-2 me-2 fa-2x ">
                <i class="fas fa-arrow-left" style="font-size: 20px"></i> <!-- Menampilkan ikon saja -->
            </button>
            <h4 class="mb-0">Tambah Anggota Tani</h4>
        </div>
        <script>
            function goBack() {
                window.history.back(); // Mengarahkan pengguna ke halaman sebelumnya
            }
        </script>
        <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12 mb-3">
                <label for="kelompokTani" class="form-label">Kelompok Tani</label>
                <select class="form-control" id="kelompok_tani" name="kelompok_tani_id" required>
                    <option value="" selected disabled>Pilih Kelompok Tani</option>
                    @foreach ($kelompokTani as $kelompok)
                        <option value="{{ $kelompok->id }}">{{ $kelompok->nama_kelompok }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="namaAnggota" class="form-label">Nama Anggota</label>
                    <input type="text" class="form-control" name="nama_anggota" id="nama_anggota"
                        placeholder="Masukkan nama anggota" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="noKtp" class="form-label">Foto KTP</label>
                    <input type="file" class="form-control" id="ktp_path" name="ktp_path" accept="image/*" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kk" class="form-label">Foto KK</label>
                    <input type="file" class="form-control" id="kk" name="kk" accept="image/*" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="buku_nikah" class="form-label">Foto Buku Nikah</label>
                    <input type="file" class="form-control" id="buku_nikah" name="buku_nikah" accept="image/*" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Masukkan alamat"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="noHp" class="form-label">No HP</label>
                    <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Masukkan nomor HP"
                        required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Tambah Data</button>
        </form>
    </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Template/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Template/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('Template/assets/js/material-dashboard.min.js?v=3.1.0') }}"></script>
    <script src="{{ asset('Template/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf("Win") > -1;
        if (win && document.querySelector("#sidenav-scrollbar")) {
            var options = {
                damping: "0.5",
            };
            Scrollbar.init(document.querySelector("#sidenav-scrollbar"), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
@endsection
