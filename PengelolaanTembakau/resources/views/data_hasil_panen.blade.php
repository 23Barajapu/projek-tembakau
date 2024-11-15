@extends('components.template')
@section('title')
    Hasil Panen
@endsection
@section('pages')
    Hasil Panen
@endsection
@section('title-pages')
    Hasil Panen
@endsection
@section('content')
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #333;
            text-align: center;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            font-weight: 500;
            margin-top: 15px;
            /* Memberikan jarak antar label */
            color: #555;
            display: block;
            font-size: 0.9rem;
        }


        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            /* Jarak antara label dan input */
            margin-bottom: 15px;
            /* Jarak antara input dan elemen berikutnya */
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 0.9rem;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #e91e63;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            margin-top: 20px;
            /* Memberikan jarak antara tombol dan elemen sebelumnya */
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #d81b60;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            /* Memberikan jarak antar tombol */
            gap: 10px;
            /* Memberikan jarak horizontal antar tombol */
            margin-bottom: 20px;
            /* Memberikan jarak bawah antara tombol dan elemen berikutnya */
        }

        .button-container .btn {
            flex: 1;
            /* Membuat tombol memiliki lebar yang sama */
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            cursor: pointer;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-danger {
            background-color: #d81b60;
            color: white;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-danger:hover {
            background-color: #d81b60;
        }

        /* CSS untuk container card prediksi */
        .prediksi-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        /* CSS untuk card prediksi */
        .prediksi-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 280px;
            /* Ukuran card */
            font-family: 'Roboto', sans-serif;
            color: #333;
            transition: transform 0.3s;
        }

        .prediksi-card:hover {
            transform: translateY(-5px);
        }

        .prediksi-card h4 {
            font-size: 1.2rem;
            color: #2d7fc8;
            margin-bottom: 10px;
            text-align: center;
        }

        .prediksi-card p {
            font-size: 0.9rem;
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
        }

        .prediksi-card .label {
            font-weight: 500;
            color: #555;
        }

        .prediksi-card .value {
            font-weight: bold;
            color: #333;
        }
    </style>

    <h2>Data Hasil Panen</h2>

    <!-- Tombol untuk beralih antara form dan daftar -->
    <div class="button-container">
        <button id="btnFormPanen" class="btn btn-success">Tambah Data Panen</button>
        <button id="btnDaftarPanen" class="btn btn-danger">Lihat Daftar Hasil Panen</button>
    </div>

    <!-- Form Hasil Panen -->
    <form id="formPanen" class="card" action="{{ route('hasil-panen.store') }}" method="POST">
        @csrf
        <label for="namaLahan">Nama Lahan:</label>
        <input type="text" id="namaLahan" name="namaLahan" required />

        <label for="namaPengurus">Nama Pengurus Lahan:</label>
        <input type="text" id="namaPengurus" name="namaPengurus" readonly />

        <label for="tanggalPenanaman">Tanggal Penanaman:</label>
        <input type="date" id="tanggalPenanaman" name="tanggalPenanaman" required />

        <label for="tanggalPanen">Tanggal Panen:</label>
        <input type="date" id="tanggalPanen" name="tanggalPanen" required />

        <label for="jumlahPanen">Jumlah Panen (Kg):</label>
        <input type="number" id="jumlahPanen" name="jumlahPanen" required />

        <label for="hargaGradeA">Harga per kg Grade A (Rp):</label>
        <input type="number" id="hargaGradeA" name="hargaGradeA" min="80000" max="130000" required />

        <label for="hargaGradeB">Harga per kg Grade B (Rp):</label>
        <input type="number" id="hargaGradeB" name="hargaGradeB" min="60000" max="100000" required />

        <label for="hargaGradeC">Harga per kg Grade C (Rp):</label>
        <input type="number" id="hargaGradeC" name="hargaGradeC" min="60000" max="80000" required />

        <button type="submit" class="btn btn-primary">Tambah Data Panen</button>
    </form>

    <!-- Daftar Hasil Panen -->
    <div id="daftarPanen" class="">
        <h3>Daftar Hasil Panen</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="tabelPanen">
                <thead>
                    <tr>
                        <th>Nama Lahan</th>
                        <th>Tanggal Penanaman</th>
                        <th>Tanggal Panen</th>
                        <th>Pendapatan Grade A (Rp)</th>
                        <th>Pendapatan Grade B (Rp)</th>
                        <th>Pendapatan Grade C (Rp)</th>
                        <th>Harga Terendah Grade A (Rp)</th>
                        <th>Harga Tertinggi Grade A (Rp)</th>
                        <th>Harga Terendah Grade B (Rp)</th>
                        <th>Harga Tertinggi Grade B (Rp)</th>
                        <th>Harga Terendah Grade C (Rp)</th>
                        <th>Harga Tertinggi Grade C (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Menambahkan data panen dari JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Prediksi Hasil Panen -->
    <div id="tabelPrediksiPanen" style="display: none;">
        <h3 style="text-align: center; margin-bottom: 20px;">Prediksi Hasil Panen</h3>

        <!-- Container untuk Card Layout -->
        <div id="prediksiCardContainer" class="prediksi-container">
            <!-- Card prediksi akan ditambahkan di sini oleh JavaScript -->
        </div>

        <!-- Container untuk Tabel Layout -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama Lahan</th>
                    <th>Jumlah Panen (Kg)</th>
                    <th>Pendapatan Grade A (Rp)</th>
                    <th>Pendapatan Grade B (Rp)</th>
                    <th>Pendapatan Grade C (Rp)</th>
                    <th>Harga Terendah Grade A (Rp)</th>
                    <th>Harga Tertinggi Grade A (Rp)</th>
                    <th>Harga Terendah Grade B (Rp)</th>
                    <th>Harga Tertinggi Grade B (Rp)</th>
                    <th>Harga Terendah Grade C (Rp)</th>
                    <th>Harga Tertinggi Grade C (Rp)</th>
                </tr>
            </thead>
            <tbody id="prediksiTableBody">
                <!-- Data prediksi tabel akan ditambahkan di sini oleh JavaScript -->
            </tbody>
        </table>
    </div>


    <!-- Load Bootstrap JS dan dependency lainnya -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript untuk mengelola form dan tabel hasil panen -->
    <script>
        document.getElementById("namaLahan").addEventListener("input", function() {
            const namaLahan = this.value;
            fetch(`/get-pengurus?namaLahan=${namaLahan}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("namaPengurus").value = data.pengurus || "";
                });
        });

        function showFormPanen() {
            document.getElementById("formPanen").style.display = "block";
            document.getElementById("daftarPanen").style.display = "none";
            document.getElementById("tabelPrediksiPanen").style.display = "none";
        }

        function showDaftarPanen() {
            document.getElementById("formPanen").style.display = "none";
            document.getElementById("daftarPanen").style.display = "block";
            document.getElementById("tabelPrediksiPanen").style.display = "none";
        }

        // Panggil fungsi showFormPanen() untuk tampilan awal
        showFormPanen();

        // Fungsi untuk mengambil data panen dari database dan memperbarui tabel
        function updateTabelPanen() {
            fetch('/hasil-panen/data')
                .then(response => response.json())
                .then(data => {
                    const tabelBody = document.querySelector("#tabelPanen tbody");
                    tabelBody.innerHTML = "";

                    data.forEach(panen => {
                        const row = tabelBody.insertRow();
                        row.innerHTML = `
                    <td>${panen.namaLahan}</td>
                    <td>${new Date(panen.tanggalPenanaman).toLocaleDateString("id-ID")}</td>
                    <td>${new Date(panen.tanggalPanen).toLocaleDateString("id-ID")}</td>
                    <td>${panen.jumlahPanen.toFixed(2)} kg</td>
                    <td>Rp ${panen.hargaPerBuah.toLocaleString("id-ID")}</td>
                    <td>
                        <button onclick="editData('${panen.id}')" class="btn btn-warning btn-sm">Edit</button>
                        <button onclick="hapusData('${panen.id}')" class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                    <td>
                        <button onclick="prediksiHasilPanen('${panen.namaLahan}', '${panen.id}')" class="btn btn-success btn-sm">Prediksi</button>
                    </td>
                `;
                    });
                });
        }

        function editData(id) {
            fetch(`/hasil-panen/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("namaLahan").value = data.namaLahan;
                    document.getElementById("tanggalPenanaman").value = data.tanggalPenanaman;
                    document.getElementById("tanggalPanen").value = data.tanggalPanen;
                    document.getElementById("jumlahPanen").value = data.jumlahPanen;
                    document.getElementById("hargaGradeA").value = data.hargaGradeA;
                    document.getElementById("hargaGradeB").value = data.hargaGradeB;
                    document.getElementById("hargaGradeC").value = data.hargaGradeC;

                    showFormPanen();
                });
        }

        function hapusData(id) {
            fetch(`/hasil-panen/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(() => updateTabelPanen());
        }

        function prediksiHasilPanen(jumlahPanen, hargaGradeA, hargaGradeB, hargaGradeC) {
            fetch(`/prediksi`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        jumlahPanen,
                        hargaGradeA,
                        hargaGradeB,
                        hargaGradeC
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                });
        }

        document.getElementById("formPanen").addEventListener("submit", function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                }).then(response => response.json())
                .then(data => {
                    if (data.message === 'Data berhasil disimpan') {
                        alert(data.message);
                        this.reset();
                        updateTabelPanen();
                    } else {
                        alert(data.message + ": " + data.error); // Menampilkan error detail
                    }
                });
        });

        document.getElementById("btnFormPanen").addEventListener("click", showFormPanen);
        document.getElementById("btnDaftarPanen").addEventListener("click", showDaftarPanen);

        // Panggil fungsi update tabel saat halaman pertama kali dimuat
        updateTabelPanen();
    </script>
@endsection
