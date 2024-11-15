div
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Penjualan Tembakau</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="Template FrontEnd/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="Template FrontEnd/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="Template FrontEnd/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="Template FrontEnd/css/style.css" rel="stylesheet">
    <style>
        .text-left-center {
            text-align: left;
            /* Align text to the left */
            vertical-align: middle;
            /* Center the content vertically */
        }

        .img-fluid {
            /* You can keep your existing styles for images */
            width: 80px;
            height: 50px;
        }
    </style>
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <x-navpengunjung></x-navpengunjung>


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4">Billing details</h1>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const subtotal = {{ $keranjangs->sum('sub_total') }}; // Ambil subtotal dari server
                    const totalElement = document.getElementById('total'); // Elemen total

                    // Fungsi untuk memperbarui total
                    function updateTotal(shippingCost) {
                        const total = subtotal + shippingCost;
                        totalElement.textContent = 'Rp' + new Intl.NumberFormat('id-ID').format(total);
                    }

                    // Tambahkan event listener pada setiap opsi layanan pengiriman
                    document.querySelectorAll('input[name="nama_layanan"]').forEach(function(radio) {
                        radio.addEventListener('change', function() {
                            const selectedService = this.value;
                            const costElement = this.closest('.form-check').querySelector(
                                '.form-check-label strong + br + strong');

                            if (costElement) {
                                // Mengambil harga layanan dari elemen label
                                const shippingCostText = costElement.nextSibling
                                    .textContent; // Ambil teks setelah strong
                                const shippingCost = parseInt(shippingCostText.replace(/Rp|\.|,/g, ''),
                                    10); // Hapus "Rp", ".", dan "," dan ubah menjadi integer
                                updateTotal(shippingCost); // Update total
                            }

                        });
                    });
                });
            </script>
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-4">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Data {{ $user->name }}</h5>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="form-item mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input id="nama" name="nama" class="form-control"
                                            value="{{ $user->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input id="alamat" name="alamat" class="form-control" value="{{ $user->alamat }}"
                                    readonly>
                            </div>
                            <div class="form-item mb-3">
                                <label for="alamat" class="form-label">Kota</label>
                                <input id="alamat" name="alamat" class="form-control" value="{{ $user->kota }}"
                                    readonly>
                            </div>
                            <div class="form-item mb-3">
                                <label for="telepon" class="form-label">Nomor Telepon</label>
                                <input id="telepon" name="telepon" class="form-control" value="{{ $user->telepon }}"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-item mb-3">
                        <form action="{{ route('form.ongkir') }}" method="POST">
                            @csrf
                            @foreach ($keranjangs as $keranjang)
                                <input type="hidden" name="ids[]" value="{{ $keranjang->id }}">
                            @endforeach
                            <input type="hidden" value="{{ $adminCityId }}" name="origin" id="origin">
                            <input type="hidden" value="{{ $userCityId }}" name="destination" id="destination">
                            <input type="hidden" value="{{ $beratGram }}" name="weight" id="weight">
                            <div class="mb-3">
                                <label for="courier" class="form-label">Kurir</label>
                                <select name="courier" id="courier" class="form-control">
                                    <option value="">Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS Indonesia</option>
                                    <option value="tiki">TIKI</option>
                                </select>
                            </div>

                            <button type="submit" name="cekOngkir"
                                class="btn border-secondary py-3 px-4
                                    text-uppercase w-100 text-primary">Cek
                                Ongkir</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 col-xl-8">
                    <form action="{{ route('konfirmasi.pembayaran') }}" method="POST">
                        @csrf
                        <!-- DATA DATA YANG AKAN DIKIRM KE KONFIRMASI PEMABAYARAN-->
                        <input type="hidden" id="nama" name="nama" class="form-control"
                            value="{{ $user->name }}">
                        <input type="hidden" id="alamat" name="alamat" class="form-control"
                            value="{{ $user->alamat }}">
                        <input type="hidden" id="kota" name="kota" class="form-control"
                            value="{{ $user->kota }}">
                        <input type="hidden" id="telepon" name="telepon" class="form-control"
                            value="{{ $user->telepon }}">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keranjangs as $keranjang)
                                        <input type="hidden" name="ids[]" value="{{ $keranjang->id }}">
                                        <input type="hidden" name="berat"
                                            value="{{ $keranjangs->sum(function ($keranjang) {return $keranjang->jumlah;}) }}">

                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="images/{{ $keranjang->barang->gambar_brg }}"
                                                        class="img-fluid" style="width: 80px; height: 50px;"
                                                        alt="{{ $keranjang->barang->nama }}">

                                                </div>
                                            </th>
                                            <td class="text-left-center ">{{ $keranjang->barang->nama }}</td>
                                            <td class="text-left-center ">
                                                Rp{{ number_format($keranjang->barang->harga, 0, ',', '.') }}</td>
                                            <td class="text-left-center ">{{ $keranjang->jumlah }}</td>
                                            <td class="text-left-center ">
                                                Rp{{ number_format($keranjang->sub_total, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="row"></th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark text-uppercase py-3">SUB TOTAL</p>
                                        </td>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">
                                                    Rp{{ number_format($keranjangs->sum('sub_total'), 0, ',', '.') }}
                                                </p>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-5">
                                @if ($ongkir != null)
                                    <h3>Layanan Pengiriman</h3>
                                    <style>
                                        .kurir-services {
                                            display: flex;
                                            flex-wrap: wrap;
                                            /* Agar elemen tidak terpotong jika melebihi lebar layar */
                                            gap: 20px;
                                            /* Jarak antar elemen */
                                        }

                                        .service-item {
                                            border: 1px solid #ddd;
                                            padding: 15px;
                                            border-radius: 5px;
                                            width: calc(50% - 10px);
                                            /* Lebar 50% - 10px untuk jarak antar item */
                                            box-sizing: border-box;
                                            /* Atur lebar setiap layanan */
                                        }
                                    </style>

                                    @foreach ($ongkir as $kurir)
                                        <div class="kurir">
                                            <h4>{{ $kurir['name'] }}</h4>
                                            <input type="hidden" name="nama_pengiriman" id="nama_pengiriman"
                                                value="{{ $kurir['name'] }}">

                                            @if (!empty($kurir['costs']))
                                                <div class="kurir-services">
                                                    @foreach ($kurir['costs'] as $cost)
                                                        <div class="form-check service-item">
                                                            <input class="form-check-input" type="radio"
                                                                name="nama_layanan"
                                                                id="{{ $kurir['code'] . '-' . $cost['service'] }}"
                                                                value="{{ $kurir['code'] . '-' . $cost['service'] }}"
                                                                required>

                                                            <!-- Input Radio untuk harga_layanan yang disembunyikan -->
                                                            <input type="radio" name="harga_layanan"
                                                                id="harga_{{ $kurir['code'] . '-' . $cost['service'] }}"
                                                                value="{{ $cost['cost'][0]['value'] }}">
                                                            <label class="form-check-label"
                                                                for="{{ $kurir['code'] . '-' . $cost['service'] }}">
                                                                <strong>Layanan:</strong> {{ $cost['service'] }} -
                                                                {{ $cost['description'] }} <br>
                                                                <strong>Harga:</strong>
                                                                Rp{{ number_format($cost['cost'][0]['value'], 0, ',', '.') }}
                                                                <br>
                                                                <strong>Estimasi Waktu:</strong>
                                                                {{ $cost['cost'][0]['etd'] }} hari

                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p>Layanan tidak tersedia untuk kurir ini.</p>
                                            @endif
                                        </div>
                                        <hr>
                                    @endforeach
                                @endif
                            </div>


                            <!-- Baris Total -->
                            <tr>
                                <th scope="row"></th>
                                <td class="py-5">
                                    <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                </td>
                                <td class="py-5"></td>
                                <td class="py-5"></td>
                                <td class="py-5">
                                    <div class="py-3 border-bottom border-top">
                                        <p id="total" class="mb-0 text-dark">
                                            Rp{{ number_format($keranjangs->sum('sub_total'), 0, ',', '.') }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </div>
                        <div class="form-item py-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="4"
                                placeholder="Masukkan catatan untuk penjual (Optional)"></textarea>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place
                                Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout Page End -->


    <!-- Footer Start -->
    <x-footer></x-footer>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid
                            copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your
                            Site Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML
                        Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="Template FrontEnd/lib/easing/easing.min.js"></script>
    <script src="Template FrontEnd/lib/waypoints/waypoints.min.js"></script>
    <script src="Template FrontEnd/lib/lightbox/js/lightbox.min.js"></script>
    <script src="Template FrontEnd/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="Template FrontEnd/js/main.js"></script>
</body>

</html>
