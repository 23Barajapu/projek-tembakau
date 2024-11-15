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
            <h4 class=" mb-4">Data Lahan</h4>
            <a href="{{ route('lahan.create') }}" class="btn btn-primary mb-4">Tambah Lahan</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($lahan->isEmpty())
            <div class="alert alert-info">
                Data sedang tidak tersedia, silakan tambahkan data.
            </div>
        @else
            <!-- Tabel untuk menampilkan data lahan -->
            <div class="table-responsive">
                <table class="table table-striped" id="lahanTable">
                    <thead class="tabel">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Lahan</th>
                            <th>Anggota Pemilik Lahan</th>
                            <th>Luas Lahan (m²)</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Foto PBB</th>
                            <th>Foto Lahan</th>
                            <th>Setfikat Lahan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lahan as $index => $a)
                            <!-- Add index for numbering -->
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Display number -->
                                <td>{{ $a->nama_lahan }}</td>
                                <td>{{ $a->AnggotaTani->nama_anggota ?? 'Tidak ada data pengurus' }}</td>
                                <td>{{ $a->luas_lahan }}</td>
                                <td>{{ $a->alamat_lahan }}</td>
                                <td>{{ $a->status }}</td>
                                <td>
                                    <img src="{{ asset('pbb/' . $a->pbb) }}" alt="Foto PBB"
                                        style="max-width: 15rem; max-height: 20rem;">
                                </td>
                                <td>
                                    <img src="{{ asset('lahan/' . $a->foto_lahan) }}" alt="Foto Lahan"
                                        style="max-width: 15rem; max-height: 20rem;">
                                </td>
                                <td>
                                    <img src="{{ asset('sertif/' . $a->sertifikat_lahan) }}" alt="Sertifikat Lahan"
                                        style="max-width: 15rem; max-height: 20rem;">
                                </td>

                                <td class="text-center"> <!-- Tambahkan class text-center untuk penataan -->
                                    <a href="{{ route('lahan.edit', $a->id) }}"
                                        class="btn btn-warning btn-sm mb-1">Edit</a>
                                    <form action="{{ route('lahan.destroy', $a->id) }}" method="POST"
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
