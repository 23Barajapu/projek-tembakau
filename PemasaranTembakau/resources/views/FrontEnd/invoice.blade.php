<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $pemesanan->id_pmsan }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            text-align: left;
            color: #333;
        }

        .invoice-header {
            border-bottom: 2px solid #ddd;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .invoice-header p {
            margin: 5px 0;
            text-align: left;
        }

        .invoice-header .logo {
            width: 100px;
            /* Ganti dengan ukuran logo */
            margin-bottom: 10px;
        }

        .invoice-header .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #4CAF50;
            /* Warna judul invoice */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            /* Warna header tabel */
            color: white;
        }

        .thead {
            background-color: #4CAF50;
            /* Warna header tabel */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Warna baris genap */
        }

        .total {
            font-weight: bold;
            text-align: right;
            color: #333;
            margin-top: 20px;
            margin-right: 10%;
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
    <div class="container">
        <div class="invoice-header">
            <!--<img src="logo.png" alt="Logo Perusahaan" class="logo"> <!-- Ganti dengan path logo -->
            <h2 class="invoice-title">Invoice #{{ $pemesanan->id_pmsan }}</h2>
            <p>Tanggal: {{ \Carbon\Carbon::parse($pemesanan->tgl_pmsan)->format('d F Y') }}</p>
            <hr>
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

        <div class="footer">
            <p>Terima kasih telah berbelanja dengan kami!</p>
            <p>&copy; {{ date('Y') }} Nama Institusi / Perusahaan. Semua hak dilindungi.</p>
        </div>
    </div>
</body>

</html>
