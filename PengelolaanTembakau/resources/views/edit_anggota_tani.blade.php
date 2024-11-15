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

    <div class="container mt-4">
        <!-- Tombol Back dengan Ikon Saja -->
        <div class="d-flex align-items-center">
            <!-- Tombol Back dengan Ikon Saja -->
            <button onclick="goBack()" class="btn btn-lg p-2 me-2 fa-2x ">
                <i class="fas fa-arrow-left" style="font-size: 20px"></i> <!-- Menampilkan ikon saja -->
            </button>
            <h4 class="mb-0">Edit Anggota Tani</h4>
        </div>
        <script>
            function goBack() {
                window.history.back(); // Mengarahkan pengguna ke halaman sebelumnya
            }
        </script>
        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kelompokTani" class="form-label">Kelompok Tani</label>
                    <select class="form-control" id="kelompok_tani" name="kelompok_tani_id" required>
                        <option value="{{ $anggota->kelompokTani->id }}" selected>
                            {{ $anggota->kelompokTani->nama_kelompok }}</option>
                        @foreach ($kelompokTani as $kelompok)
                            <option value="{{ $kelompok->id }}">{{ $kelompok->nama_kelompok }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="namaAnggota" class="form-label">Nama Anggota</label>
                    <input type="text" class="form-control" id="nama_anggota" placeholder="Masukkan nama anggota"
                        name="nama_anggota" value="{{ $anggota->nama_anggota }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat" name="alamat"
                        value="{{ $anggota->alamat }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="noHp" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" id="telepon" placeholder="Masukkan nomor HP" name="telepon"
                        value="{{ $anggota->telepon }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="Ktp" class="form-label">KTP</label>
                    <input type="file" class="form-control" id="ktp_path" name="ktp_path" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="foto_ktp">Gambar KTP</label><br>
                    <img src="{{ asset('ktp/' . $anggota->ktp_path) }}" alt="KTP" style="max-width: 30rem;">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kk" class="form-label">KK</label>
                    <input type="file" class="form-control" id="kk" name="kk" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="kk">Gambar kk</label><br>
                    <img src="{{ asset('kk/' . $anggota->kk) }}" alt="KK" style="max-width: 30rem;">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="buku_nikah" class="form-label">Buku Nikah</label>
                    <input type="file" class="form-control" id="buku_nikah" name="buku_nikah" accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="buku_nikah">Gambar Buku Nikah</label><br>
                    <img src="{{ asset('buku_nikah/' . $anggota->ktp_path) }}" alt="Buku Nikah" style="max-width: 30rem;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Data</button>
        </form>
    </div>
@endsection
