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
    <div class="container">
        <!-- Tombol Back dengan Ikon Saja -->
        <div class="d-flex align-items-center">
            <!-- Tombol Back dengan Ikon Saja -->
            <button onclick="goBack()" class="btn btn-lg p-2 me-2 fa-2x ">
                <i class="fas fa-arrow-left" style="font-size: 20px"></i> <!-- Menampilkan ikon saja -->
            </button>
            <h4 class="mb-0">Tambah Jadwal Lahan</h4>
        </div>
        <script>
            function goBack() {
                window.history.back(); // Mengarahkan pengguna ke halaman sebelumnya
            }
        </script>

        <!-- Card untuk form -->
        <div class="card mt-4 mb-4">
            <div class="card-body">
                <!-- Form untuk menambahkan data rundown -->
                <form id="rundownForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="namaLahan" class="form-label">Nama Lahan</label>
                            <input type="text" class="form-control" id="namaLahan" placeholder="Masukkan Nama Lahan"
                                required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jenisKomoditas" class="form-label">Jenis Komoditas</label>
                            <input type="text" class="form-control" id="jenisKomoditas"
                                placeholder="Masukkan Jenis Komoditas" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggalTanam" class="form-label">Tanggal Tanam</label>
                            <input type="date" class="form-control" id="tanggalTanam" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="ukuranLahan" class="form-label">Ukuran Lahan (m²)</label>
                            <input type="number" class="form-control" id="ukuranLahan"
                                placeholder="Masukkan Ukuran Lahan (m²)" required />
                        </div>
                    </div>
                    <div>
                        <h6>Tanggal Panen: <span id="prediksiPanen"></span></h6>
                    </div>
                    <div>
                        <h6>Prediksi Hasil Panen: <span id="totalHasil">0</span> kg</h6>
                    </div>
                    <input type="hidden" id="editIndex" value="" />
                    <button id="addButton" class="btn btn-primary" onclick="addJadwal()">Tambah</button>
                    <button onclick="window.location.href='output.html'" class="btn btn-primary">Semua
                        Lahan</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </main>

    <script>
        function formatTanggal(tanggal) {
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            return new Date(tanggal).toLocaleDateString('id-ID', options);
        }
        // Ambil elemen input dan output
        const tanggalTanamInput = document.getElementById("tanggalTanam");
        const prediksiPanenOutput = document.getElementById("prediksiPanen");

        // Event listener untuk input tanggal tanam
        tanggalTanamInput.addEventListener("input", function() {
            const tanggalTanam = new Date(this.value); // Ambil nilai input sebagai objek Date

            // Cek apakah tanggal tanam valid
            if (!isNaN(tanggalTanam)) {
                const tanggalPanen = new Date(tanggalTanam); // Buat salinan dari tanggal tanam
                tanggalPanen.setDate(tanggalPanen.getDate() + 85); // Tambah 85 hari

                // Format tanggal panen dalam format yang diinginkan (DD/MM/YYYY)
                const options = {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                };
                prediksiPanenOutput.textContent = tanggalPanen.toLocaleDateString('id-ID',
                    options); // Tampilkan hasil
            } else {
                prediksiPanenOutput.textContent = ""; // Kosongkan jika tanggal tanam tidak valid
            }
        });

        // Hasil tembakau per meter persegi
        const hasilPerHekter = 8000; // kg

        // Ambil elemen input dan hasil
        const luasLahanInput = document.getElementById("ukuranLahan");
        const totalHasilOutput = document.getElementById("totalHasil");

        // Event listener untuk input
        luasLahanInput.addEventListener("input", function() {
            const luasLahan = parseInt(this.value) || 0; // Ambil nilai input atau 0 jika kosong
            const totalHasil = luasLahan * hasilPerHekter; // Hitung total hasil
            totalHasilOutput.textContent = totalHasil; // Tampilkan hasil dengan 2 desimal
        });

        function addJadwal() {
            event.preventDefault();

            const namaLahan = document.getElementById("namaLahan").value;
            const tanggalTanam = document.getElementById("tanggalTanam").value;
            const jenisKomoditas = document.getElementById("jenisKomoditas").value;
            const ukuranLahan = parseInt(document.getElementById("ukuranLahan").value);

            let jadwalArray = JSON.parse(localStorage.getItem("jadwalArray")) || [];
            jadwalArray.push({
                namaLahan,
                tanggalTanam,
                jenisKomoditas,
                ukuranLahan,
            });
            localStorage.setItem("jadwalArray", JSON.stringify(jadwalArray));

            clearForm();

            // Redirect ke output.html setelah data berhasil ditambahkan
            window.location.href = 'output.html';
        }

        function clearForm() {
            document.getElementById("namaLahan").value = "";
            document.getElementById("tanggalTanam").value = "";
            document.getElementById("jenisKomoditas").value = "";
            document.getElementById("ukuranLahan").value = "";
        }
    </script>
@endsection
