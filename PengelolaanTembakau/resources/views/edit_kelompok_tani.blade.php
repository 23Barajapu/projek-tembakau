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
            <h4 class="mb-0">Edit Kelompok Tani</h4>
        </div>
        <script>
            function goBack() {
                window.history.back(); // Mengarahkan pengguna ke halaman sebelumnya
            }
        </script>
        <form action="{{ route('kelompok_tani.update', $kelompokTani->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Kelompok</label>
                <input type="text" name="nama_kelompok" class="form-control"
                    value="{{ old('nama_kelompok', $kelompokTani->nama_kelompok ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelompok</label>
                <input type="text" name="jenis_kelompok" class="form-control"
                    value="{{ old('jenis_kelompok', $kelompokTani->jenis_kelompok ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Jumlah Anggota</label>
                <input type="number" name="jumlah_anggota" class="form-control"
                    value="{{ old('jumlah_anggota', $kelompokTani->jumlah_anggota ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Ketua Kelompok</label>
                <input type="text" name="ketua_kelompok" class="form-control"
                    value="{{ old('ketua_kelompok', $kelompokTani->ketua_kelompok ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Desa</label>
                <input type="text" name="desa" class="form-control"
                    value="{{ old('desa', $kelompokTani->desa ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" name="kecamatan" class="form-control"
                    value="{{ old('kecamatan', $kelompokTani->kecamatan ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Penyuluh</label>
                <input type="text" name="penyuluh" class="form-control"
                    value="{{ old('penyuluh', $kelompokTani->penyuluh ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>NIP Penyuluh</label>
                <input type="text" name="nip_penyuluh" class="form-control"
                    value="{{ old('nip_penyuluh', $kelompokTani->nip_penyuluh ?? '') }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3 w-100">Update</button>
        </form>
    </div>
@endsection
