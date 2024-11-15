<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMD9Tl4CxMLeTVbVAvEzTlJl5hzi7fKfT5N8kyD" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Material Dashboard 2 by Creative Tim</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-200">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-QF4MYhCsQppavJ2pU8rmv/Ai0O6U8KvBi5i5RXm3oR9P5eU8IkmXK0zG0q4ABMim" crossorigin="anonymous">
    </script>
    <x-navbar></x-navbar>




    <div class="container">
        <h3>Data Jadwal Lahan</h3>
        <div class="row" id="jadwalList"></div>
        <button class="btn btn-primary mt-4" onclick="window.location.href='jadwal_lahan.html'">Kembali</button>
    </div>


    <script>
    function formatTanggal(tanggal) {
        const options = {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        return new Date(tanggal).toLocaleDateString('id-ID', options);
    }

    function renderJadwal() {
        const jadwalList = document.getElementById('jadwalList');
        jadwalList.innerHTML = '';
        const jadwalArray = JSON.parse(localStorage.getItem('jadwalArray')) || [];
        jadwalArray.forEach((item, index) => {
            // Format tanggal dan tampilkan
            const formattedTanggalTanam = formatTanggal(item.tanggalTanam);
            const jumlahPanen = item.ukuranLahan * 3;
            const tanamDate = new Date(item.tanggalTanam);

            // Hitung tanggal panen
            const tanggalPanen = new Date(tanamDate);
            tanggalPanen.setDate(tanggalPanen.getDate() + 85);
            const formattedTanggalPanen = formatTanggal(tanggalPanen); // Format tanggal panen

            // Tanggal untuk kegiatan
            const tanggalKegiatan1 = new Date(tanamDate);
            tanggalKegiatan1.setDate(tanggalKegiatan1.getDate() + 15);
            const formattedTanggalKegiatan1 = formatTanggal(tanggalKegiatan1);

            const tanggalKegiatan2 = new Date(tanamDate);
            tanggalKegiatan2.setDate(tanggalKegiatan2.getDate() + 30);
            const formattedTanggalKegiatan2 = formatTanggal(tanggalKegiatan2);

            const tanggalKegiatan3 = new Date(tanamDate);
            tanggalKegiatan3.setDate(tanggalKegiatan3.getDate() + 50);
            const formattedTanggalKegiatan3 = formatTanggal(tanggalKegiatan3);

            const tanggalKegiatan4 = new Date(tanamDate);
            tanggalKegiatan4.setDate(tanggalKegiatan4.getDate() + 70);
            const formattedTanggalKegiatan4 = formatTanggal(tanggalKegiatan4);

            const tanggalKegiatan5 = new Date(tanamDate);
            tanggalKegiatan5.setDate(tanggalKegiatan5.getDate() + 85);
            const formattedTanggalKegiatan5 = formatTanggal(tanggalKegiatan5);

            const tanggalKegiatan6 = new Date(tanamDate);
            tanggalKegiatan6.setDate(tanggalKegiatan6.getDate() + 100);
            const formattedTanggalKegiatan6 = formatTanggal(tanggalKegiatan6);

            const tanggalKegiatan7 = new Date(tanamDate);
            tanggalKegiatan7.setDate(tanggalKegiatan7.getDate() + 110);
            const formattedTanggalKegiatan7 = formatTanggal(tanggalKegiatan7);

            const tanggalKegiatan8 = new Date(tanamDate);
            tanggalKegiatan8.setDate(tanggalKegiatan8.getDate() + 130);
            const formattedTanggalKegiatan8 = formatTanggal(tanggalKegiatan8);

            const div = document.createElement("div");
            div.className =
                "col-lg-4 col-md-6 col-sm-12 mb-4 jadwal-item"; // Responsif grid untuk 3 item di layar besar, 2 di medium, dan 1 di ponsel
            div.innerHTML = `
                <div class="card">
                  <div class="card-body">
                    <strong>Nama Lahan:</strong> ${item.namaLahan}<br>
                    <strong>Tanggal Tanam:</strong> ${formattedTanggalTanam}<br>
                    <strong>Tanggal Panen:</strong> ${formattedTanggalPanen}<br>
                    <strong>Komoditas:</strong> ${item.jenisKomoditas}<br>
                    <strong>Ukuran:</strong> ${item.ukuranLahan} m²<br>
                    <strong>Prediksi Jumlah Panen:</strong> ${jumlahPanen} kg<br>
                    <button class="btn btn-info btn-sm mt-2" onclick="toggleKegiatan(${index})">Selengkapnya</button>
                    <div class="kegiatan mt-2" id="kegiatan-${index}" style="display: none;">
                      <strong>1. Hari 1-15:</strong> Persiapan lahan dan penanaman.<br>
                      <strong>Tanggal:</strong> ${formattedTanggalTanam} - ${formattedTanggalKegiatan1}<br>
                      <strong>2. Hari 16-30:</strong> Adaptasi dan awal pertumbuhan.<br>
                      <strong>Tanggal:</strong> ${formattedTanggalKegiatan1} - ${formattedTanggalKegiatan2}<br>
                      <strong>3. Hari 31-50:</strong> Pertumbuhan intensif dan perawatan.<br>
                      <strong>Tanggal:</strong> ${formattedTanggalKegiatan2} - ${formattedTanggalKegiatan3}<br>
                      <strong>4. Hari 51-70:</strong> Pembentukan daun dan penyiangan.<br>
                      <strong>Tanggal:</strong> ${formattedTanggalKegiatan3} - ${formattedTanggalKegiatan4}<br>
                      <strong>5. Hari 71-85:</strong> Pembesaran dan pemeliharaan daun.<br>
                      <strong>Tanggal:</strong> ${formattedTanggalKegiatan4} - ${formattedTanggalKegiatan5}<br>
                      <strong>6. Hari 86-100:</strong> Pematangan dan pemanenan.<br>
                      <strong>Tanggal:</strong> ${formattedTanggalKegiatan5} - ${formattedTanggalKegiatan6}<br>
                      <strong>7. Hari 100-110:</strong> Pengeringan Daun.<br>
                      <strong>Tanggal:</strong> ${formattedTanggalKegiatan6} - ${formattedTanggalKegiatan7}<br>
                      <strong>8. Hari 110-130:</strong> Fermentasi.<br>
                      <strong>Tanggal:</strong> ${formattedTanggalKegiatan7} - ${formattedTanggalKegiatan8}<br>
                      <strong>9. Hari 130-135:</strong> Perajangan.<br>
                      <strong>Tanggal:</strong> ${formattedTanggalKegiatan8}<br>
                    </div>
                    <button class="btn btn-warning btn-sm mt-2" onclick="editJadwal(${index})">Edit</button>
                    <button class="btn btn-danger btn-sm mt-2" onclick="deleteJadwal(${index})">Hapus</button>
                  </div>
                </div>
              `;
            jadwalList.appendChild(div);
        });
    }


    function toggleKegiatan(index) {
        const kegiatanDiv = document.getElementById(`kegiatan-${index}`);
        kegiatanDiv.style.display = kegiatanDiv.style.display === "none" || kegiatanDiv.style.display === "" ? "block" :
            "none";
    }

    function editJadwal(index) {
        const jadwalArray = JSON.parse(localStorage.getItem("jadwalArray")) || [];
        const item = jadwalArray[index];

        if (item) {
            localStorage.setItem("editIndex", index);
            localStorage.setItem("editItem", JSON.stringify(item));
            window.location.href = "edit_jadwal.html"; // Redirect ke halaman edit
        } else {
            console.error("Item not found for editing.");
        }
    }



    function deleteJadwal(index) {
        const jadwalArray = JSON.parse(localStorage.getItem("jadwalArray"));
        jadwalArray.splice(index, 1);
        localStorage.setItem("jadwalArray", JSON.stringify(jadwalArray));
        renderJadwal();
    }

    window.onload = renderJadwal;
    </script>

    <style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .card-body {
        padding: 15px;
    }

    .kegiatan {
        margin-top: 10px;
        padding: 10px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }
    </style>
    </script>

    <!-- Bootstrap JS (with Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <style>
    .blink {
        animation: blink-animation 1s steps(5, start) infinite;
        -webkit-animation: blink-animation 1s steps(5, start) infinite;
    }

    @keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }

    @-webkit-keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }
    </style>
    </main>
    <div class="fixed-plugin">
    </div>
    <!-- Core JS Files -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>

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

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <script>
    function loadMaterialDashboard() {
        var script = document.createElement('script');
        script.src = "../assets/js/material-dashboard.min.js";
        script.type = "module"; // Pastikan file tersebut di-load sebagai modul jika diperlukan
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }
    </script>
</body>

</html>