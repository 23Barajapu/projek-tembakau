<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $pemesanan->id_pmsan }}</title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Stylesheets -->
    <link href="{{ asset('Template FrontEnd/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Template FrontEnd/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Stylesheet -->
    <link href="{{ asset('Template FrontEnd/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href="{{ asset('Template FrontEnd/css/style.css') }}" rel="stylesheet">

    <style>
        h1,
        h2 {
            font-family: 'Raleway', sans-serif;
            color: #333;
        }

        main {
            padding-top: 10em;
        }

        .invoice-header img {
            width: 120px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
        }

        .invoice-details {
            margin: 20px 0;
        }

        .invoice-details p {
            margin: 0;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .thead {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .custom-button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-download {
            background-color: #007bff;
            color: white;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
        }

        .custom-button:hover {
            opacity: 0.9;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>

<body>

    <x-navpengunjung></x-navpengunjung>

    <main class="mt-5">
        <div class="container">
            <div class="invoice-header">
                <!--<img src="logo.png" alt="Logo Perusahaan"> <!-- Ganti dengan path logo -->
                <h2 class="invoice-title">Invoice #{{ $pemesanan->id_pmsan }}</h2>
            </div>

            <div class="invoice-details">
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pemesanan->tgl_pmsan)->format('d F Y') }}</p>
                <p><strong>Nama Pelanggan:</strong> {{ $pemesanan->nama }}</p>
                <p><strong>Telepon:</strong> {{ $pemesanan->telepon }}</p>
                <p><strong>Alamat:</strong> {{ $pemesanan->alamat }}</p>
            </div>

            <h2>Detail Barang</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanan->items as $item)
                        <tr>
                            <td>{{ $item->keranjang->barang->nama }}</td>
                            <td>{{ $item->keranjang->jumlah }}</td>
                            <td>Rp {{ number_format($item->keranjang->barang->harga, 0, ',', '.') }}</td>
                            <td>Rp
                                {{ number_format($item->keranjang->barang->harga * $item->keranjang->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="thead"><strong>Pengiriman</strong></td>

                        <td>Rp {{ number_format($pemesanan->harga_layanan, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="total">
                <p>Total Harga: Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>
            </div>

            <div class="button-container">
                <button class="custom-button btn-download"
                    onclick="window.location.href='{{ route('invoice.generate', $pemesanan->id_pmsan) }}'">
                    Download
                </button>
                <button class="custom-button btn-back" onclick="window.location.href='/'">
                    Kembali
                </button>
            </div>
        </div>
    </main>

    <x-footer></x-footer>

    <!-- JavaScript -->
    <script src="{{ asset('Template FrontEnd/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('Template FrontEnd/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('Template FrontEnd/js/main.js') }}"></script>
</body>

</html>
