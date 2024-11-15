@extends('components.template')
@section('title')
    Jadwal
@endsection
@section('pages')
    Jadwal
@endsection
@section('title-pages')
    Jadwal
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
            <h4 class="mb-0">Tambah Jadwal</h4>
        </div>
        <script>
            function goBack() {
                window.history.back(); // Mengarahkan pengguna ke halaman sebelumnya
            }
        </script>

        <!-- Form untuk menambahkan atau mengedit data lahan -->
        <form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12 mb-3">
                <label for="lahan" class="form-label">Lahan</label>
                <select class="form-control" id="lahan_id" name="lahan_id" required>
                    <option value="" selected disabled>Pilih Lahan</option>
                    @foreach ($lahan as $a)
                        <option value="{{ $a->id }}">{{ $a->nama_lahan }}</option>
                    @endforeach
                </select>
            </div>


            <div class="col-md-12 mb-3">
                <label for="pupuk" class="form-label">Pupuk</label>
                <select class="form-control" id="pupuk" name="pupuk" required>
                    <option value="" disabled selected>Pilih Pupuk</option>
                    <option value="Urea">Urea</option>
                    <option value="ZA">ZA (Zwavelzure Amoniak)</option>
                    <option value="SP-36">SP-36 (Super Phosphate)</option>
                    <option value="KCL">KCL (Kalium Clorida)</option>
                    <option value="NPK">NPK (Nitrogen, Phosphor, Kalium)</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label for="bibit" class="form-label">Bibit</label>
                <select class="form-control" id="bibit" name="bibit" required>
                    <option value="" disabled selected>Pilih Bibit</option>
                    <option value="Prancak 95">Prancak 95</option>
                    <option value="Kemloko">Kemloko</option>
                    <option value="Hibrida">Hibrida</option>
                    <option value="Virginia">Virginia</option>
                    <option value="Besuki">Besuki</option>
                </select>
            </div>
            <div class="col-md-12 mb-3">
                <label for="tanggal" class="form-label">Tanggal Menanam</label>
                <input type="date" class="form-control" id="tanggal_tanam" name="tanggal_tanam" required>
            </div>

            <div class="col-md-12 mb-3">
                <label for="ukuranLahan" class="form-label">Ukuran Lahan (Hektar)</label>
                <input type="text" class="form-control" id="ukuranLahan" name="ukuranLahan" readonly>
            </div>

            <div>
                <h6>Prediksi Hasil Panen: <span id="totalHasil">0</span> kg</h6>
            </div>

            <button type="submit" class="btn btn-primary w-100" id="submitButton">Tambah Data Lahan</button>

        </form>
    </div>
    <!--   Core JS Files   -->
    <script>
        document.getElementById('lahan_id').addEventListener('change', function() {
            var lahanId = this.value;
            if (lahanId) {
                // Kirim permintaan Ajax ke server untuk mendapatkan ukuran lahan
                fetch(`/get-lahan-size/${lahanId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.size) {
                            // Tampilkan ukuran lahan di input
                            document.getElementById('ukuranLahan').value = data.size;

                            // Hitung prediksi hasil
                            const hasilPerHekter = 8000; // kg per hekter persegi
                            const luasLahan = parseInt(data.size) || 0;
                            const totalHasil = luasLahan * hasilPerHekter;

                            // Tampilkan prediksi hasil panen
                            document.getElementById('totalHasil').textContent = totalHasil;
                        } else {
                            alert('Ukuran lahan tidak ditemukan.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengambil ukuran lahan.');
                    });
            }
        });
    </script>
@endsection
