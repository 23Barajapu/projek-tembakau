<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
            font-size: 14px;
            /* Mengatur ukuran font default lebih kecil */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 80px;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 20px;
            /* Ukuran font judul lebih kecil */
            margin: 0;
        }

        .header p {
            font-size: 12px;
            /* Ukuran font untuk informasi institusi */
            margin: 0;
            color: #555;
        }

        .date-range {
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
            /* Ukuran font tabel lebih kecil */
        }

        th,
        td {
            padding: 8px;
            /* Mengurangi padding agar tabel lebih ramping */
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            text-align: center;
        }

        td {
            background-color: #f9f9f9;
        }

        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 10px;
            color: #777;
        }

        .barang-info div {
            margin-bottom: 4px;
            /* Mengurangi jarak antar-barang */
        }
    </style>
</head>

<body>
    <div class="header">
        <!-- <img src="logo.png" alt="Logo Institusi"> --> <!-- Uncomment to add logo -->
        <h1>Laporan Pemesanan</h1>
        <p>Nama Institusi / Perusahaan</p>
        <p>Alamat, Telepon, Email</p>
    </div>

    <!-- Filtered Date Range -->
    <div class="date-range">
        <strong>Tanggal:</strong>
        @if ($startDate && $endDate)
            {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} -
            {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}
        @else
            Tidak ada filter tanggal.
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pemesanan</th>
                <th>Nama</th>
                <th>Barang</th>
                <th>Sub Total</th>
                <th>Harga Pengiriman</th>
                <th>Total Harga</th>
                <th>Tanggal Pemesanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemesanan as $data)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td style="text-align: center;">{{ $data->id_pmsan }}</td>
                    <td>{{ $data->nama }}</td>
                    <td class="barang-info">
                        @foreach ($data->items as $item)
                            <div>
                                <small><strong>{{ $item->keranjang->barang->nama }}</strong> -
                                    x{{ $item->keranjang->jumlah }}</small>
                                <span>Rp{{ number_format($item->keranjang->barang->harga, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </td>
                    <td>Rp{{ number_format($data->total_harga - $data->harga_layanan, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($data->harga_layanan, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($data->total_harga, 0, ',', '.') }}</td>
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($data->tgl_pmsan)->format('d F Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        &copy; {{ date('Y') }} Nama Institusi / Perusahaan. Semua hak dilindungi.
    </div>
</body>

</html>
