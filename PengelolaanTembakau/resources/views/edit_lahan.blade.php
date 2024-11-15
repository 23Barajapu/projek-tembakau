@extends('components.template')
@section('title')
    Lahan
@endsection
@section('pages')
    Lahan
@endsection
@section('title-pages')
    Lahan
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

    <div class="container">
        <!-- Tombol Back dengan Ikon Saja -->
        <div class="d-flex align-items-center">
            <!-- Tombol Back dengan Ikon Saja -->
            <button onclick="goBack()" class="btn btn-lg p-2 me-2 fa-2x ">
                <i class="fas fa-arrow-left" style="font-size: 20px"></i> <!-- Menampilkan ikon saja -->
            </button>
            <h4 class="mb-0">Edit Lahan</h4>
        </div>
        <script>
            function goBack() {
                window.history.back(); // Mengarahkan pengguna ke halaman sebelumnya
            }
        </script>

        <!-- Form untuk mengedit data lahan -->
        <form action="{{ route('lahan.update', $lahan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="pengurus_lahan" class="form-label">Pengurus Lahan</label>
                    <select class="form-control" id="pengurus_lahan" name="pengurus_lahan" required>
                        <option value="" disabled>Pilih Pengurus Lahan</option>
                        @foreach ($anggota as $a)
                            <option value="{{ $a->id }}" {{ $a->id == $lahan->pengurus_lahan }}>
                                {{ $a->nama_anggota }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="namaLahan" class="form-label">Nama Lahan</label>
                    <input type="text" class="form-control" id="namaLahan" name="namaLahan"
                        value="{{ $lahan->nama_lahan }}" placeholder="Masukkan Nama Lahan" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="luas_lahan" class="form-label">Luas Lahan (m²)</label>
                    <input type="number" class="form-control" id="luas_lahan" name="luas_lahan"
                        value="{{ $lahan->luas_lahan }}" placeholder="Masukkan Luas Lahan dalam m²" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="alamat_lahan" class="form-label">Alamat Lahan</label>
                    <input type="text" class="form-control" id="alamat_lahan" name="alamat_lahan"
                        value="{{ $lahan->alamat_lahan }}" placeholder="Masukkan Alamat Lahan" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status Lahan</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="" disabled>Pilih Status Lahan</option>
                        <option value="Milik Sendiri">Milik Sendiri</option>
                        <option value="Pinjam">Pinjam</option>
                        <option value="Sewa">Sewa</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pbb" class="form-label">Foto PBB</label>
                    <input type="file" class="form-control" id="pbb" name="pbb" accept="image/*">
                    <small>Biarkan kosong jika tidak ingin mengubah foto pbb</small>
                    <br>
                    <small>Foto PBB: </small><br>
                    <img src="{{ asset('pbb/' . $lahan->pbb) }}" alt="Foto PBB"
                        style="max-width: 30rem; max-height: 30rem;">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="foto_lahan" class="form-label">Foto Lahan</label>
                    <input type="file" class="form-control" id="foto_lahan" name="foto_lahan" accept="image/*">
                    <small>Biarkan kosong jika tidak ingin mengubah foto</small>
                    <br>
                    <small>Foto Lahan: </small><br>
                    <img src="{{ asset('lahan/' . $lahan->foto_lahan) }}" alt="lahan"
                        style="max-width: 30rem; max-height: 30rem;">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="sertif_lahan" class="form-label">Sertifikat Lahan</label>
                    <input type="file" class="form-control" id="sertif_lahan" name="sertif_lahan" accept="image/*">
                    <small>Biarkan kosong jika tidak ingin mengubah sertifikat</small>
                    <br>
                    <small>Foto Sertifikat: </small><br>
                    <img src="{{ asset('sertif/' . $lahan->sertifikat_lahan) }}" alt="sertif"
                        style="max-width: 30rem; max-height: 30rem;">
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" id="submitButton">Update Data Lahan</button>
        </form>
    </div>
@endsection
