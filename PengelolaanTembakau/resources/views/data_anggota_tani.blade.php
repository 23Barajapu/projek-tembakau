@extends('components.template')
@section('title')
    Anggota Tani
@endsection
@section('pages')
    Anggota Tani
@endsection
@section('title-pages')
    Anggota Tani
@endsection
@section('content')
    <!-- Card untuk form -->
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class=" mb-4">Data Anggota Kelompok Tani</h4>
            <a href="{{ route('anggota.create') }}" class="btn btn-primary mb-4">Tambah Anggota</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Cek apakah ada data kelompok tani -->
        @if ($anggota->isEmpty())
            <div class="alert alert-info">
                Data sedang tidak tersedia, silakan tambahkan data.
            </div>
        @else
            <div class="table-responsive text-center">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Kelompok Tani</th>
                            <th>Nama Anggota</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>KTP</th>
                            <th>KK</th>
                            <th>Buku Nikah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggota as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->kelompokTani->nama_kelompok }}</td>
                                <td>{{ $item->nama_anggota }}</td>
                                <td>{{ $item->telepon }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td><img src="{{ asset('ktp/' . $item->ktp_path) }}" alt="KTP"
                                        style="max-width: 100rem;"></td>
                                <td><img src="{{ asset('kk/' . $item->kk) }}" alt="KK" style="max-width: 100rem;">
                                </td>
                                <td><img src="{{ asset('buku_nikah/' . $item->buku_nikah) }}" alt="Buku Nikah"
                                        style="max-width: 100rem;"></td>
                                <td>
                                    <a href="{{ route('anggota.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('anggota.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
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
