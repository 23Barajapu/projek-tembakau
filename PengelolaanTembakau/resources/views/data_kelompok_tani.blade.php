@extends('components.template')
@section('title')
    Kelompok Tani
@endsection
@section('pages')
    Kelompok Tani
@endsection
@section('title-pages')
    Kelompok Tani
@endsection
@section('content')
    <style>
        .table {
            border: 1px solid #000000;
            /* Border for the entire table */
            border-radius: 0.50rem;
            /* Rounded corners */
            overflow: hidden;
            /* Ensure the border radius works */
            width: 100%;
            /* Full width */
            margin-top: 1rem;
            /* Space above the table */
        }

        .table th,
        .table td {
            padding: 1rem;
            /* Add padding inside cells */
            text-align: center;
            /* Align text to the left */
            border-bottom: 1px solid #000000;
            /* Border for rows */
        }

        .table th {
            background-color: #fdf9f9;
            /* Background for headers */
            /* White text color for headers */
            font-weight: bold;
            /* Bold text for headers */
        }

        .table tr:hover {
            background-color: #f1f1f1;
            /* Highlight row on hover */
        }
    </style>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4>Data Kelompok Tani</h4>
            <a href="{{ route('kelompok_tani.create') }}" class="btn btn-primary">Tambah Kelompok Tani</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Cek apakah ada data kelompok tani -->
        @if ($kelompokTani->isEmpty())
            <div class="alert alert-info">
                Data sedang tidak tersedia, silakan tambahkan data.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th> <!-- Add numbering column -->
                            <th>Nama Kelompok</th>
                            <th>Jenis Kelompok</th>
                            <th>Jumlah Anggota</th>
                            <th>Ketua Kelompok</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Penyuluh</th>
                            <th>NIP Penyuluh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kelompokTani as $index => $kelompok)
                            <!-- Add index for numbering -->
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Display number -->
                                <td>{{ $kelompok->nama_kelompok }}</td>
                                <td>{{ $kelompok->jenis_kelompok }}</td>
                                <td>{{ $kelompok->jumlah_anggota }}</td>
                                <td>{{ $kelompok->ketua_kelompok }}</td>
                                <td>{{ $kelompok->desa }}</td>
                                <td>{{ $kelompok->kecamatan }}</td>
                                <td>{{ $kelompok->penyuluh }}</td>
                                <td>{{ $kelompok->nip_penyuluh }}</td>
                                <td class="text-center"> <!-- Tambahkan class text-center untuk penataan -->
                                    <a href="{{ route('kelompok_tani.edit', $kelompok->id) }}"
                                        class="btn btn-warning btn-sm mb-1">Edit</a>
                                    <form action="{{ route('kelompok_tani.destroy', $kelompok->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mb-1">Hapus</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
