@extends('components.template')
@section('title')
    Kelompok Tani
@endsection
@section('pages')
    Kelompok Tani
@endsection
@section('title-pages')
    Kelompok Tani
@endsection
@section('content')
    <style>
        /* Menambahkan border pada input */
        .form-control {
            border: 1px solid #ccc;
            /* Ganti warna sesuai kebutuhan */
            border-radius: 0.50rem;
            /* Sesuaikan border radius */
            padding-left: 1rem
        }

        /* Menambahkan border pada input saat mendapatkan focus */
        .form-control:focus {
            border-color: #007bff;
            /* Ganti warna sesuai kebutuhan */
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            /* Ganti warna sesuai kebutuhan */
        }
    </style>

    <div class="container">
        <!-- Tombol Back dengan Ikon Saja -->
        <div class="d-flex align-items-center">
            <!-- Tombol Back dengan Ikon Saja -->
            <button onclick="goBack()" class="btn btn-lg p-2 me-2 fa-2x ">
                <i class="fas fa-arrow-left" style="font-size: 20px"></i> <!-- Menampilkan ikon saja -->
            </button>
            <h4 class="mb-0">Tambah Kelompok Tani</h4>
        </div>
        <script>
            function goBack() {
                window.history.back(); // Mengarahkan pengguna ke halaman sebelumnya
            }
        </script>
        <form action="{{ route('kelompok_tani.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="namaKelompok" class="form-label">Nama Kelompok Tani</label>
                    <input type="text" class="form-control" id="nama_kelompok" placeholder="Masukkan nama kelompok"
                        name="nama_kelompok" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jenisKelompok" class="form-label">Jenis Kelompok Tani</label>
                    <input type="text" class="form-control" id="jenis_kelompok" placeholder="Masukkan jenis kelompok"
                        name="jenis_kelompok" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jumlahAnggota" class="form-label">Jumlah Anggota</label>
                    <input type="number" class="form-control" id="jumlah_anggota" placeholder="Masukkan jumlah anggota"
                        name="jumlah_anggota" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="ketuaKelompok" class="form-label">Ketua Kelompok Tani</label>
                    <input type="text" class="form-control" id="ketua_kelompok" placeholder="Masukkan ketua kelompok"
                        name="ketua_kelompok" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="desa" class="form-label">Desa / Kelurahan</label>
                    <input type="text" class="form-control" id="desa" placeholder="Masukkan desa / kelurahan"
                        name="desa" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control" id="kecamatan" placeholder="Masukkan kecamatan"
                        name="kecamatan" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="penyuluh" class="form-label">Penyuluh</label>
                    <input type="text" class="form-control" id="penyuluh" placeholder="Masukkan penyuluh"
                        name="penyuluh" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nipPenyuluh" class="form-label">NIP Penyuluh</label>
                    <input type="text" class="form-control" id="nip_penyuluh" placeholder="Masukkan NIP penyuluh"
                        name="nip_penyuluh" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Tambah Data</button>
        </form>
    </div>
@endsection
