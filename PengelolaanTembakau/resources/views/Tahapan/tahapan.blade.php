@extends('components.template')
@section('title')
    Tahapan
@endsection
@section('pages')
    Tahapan
@endsection
@section('title-pages')
    Tahapan
@endsection
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Daftar Tahapan Penanaman Tembakau</h2>
        <a href="{{ route('tahapan.create') }}" class="btn btn-primary mb-3">Tambah Tahapan</a>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">

            <table class="table table-striped">
                <thead class="table table-bordered text-center">
                    <tr>
                        <th>Tahap</th>
                        <th>Nama Tahap</th>
                        <th>Deskripsi</th>
                        <th>Mulai (Hari)</th>
                        <th>Selesai (Hari)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tahapan as $index => $tahap)
                        <tr>
                            <td class="text-center">{{ $tahap->tahap }}</td>
                            <td>{{ $tahap->nama_tahap }}</td>
                            <!-- DESKRIPSI-->
                            @php
                                // Memecah deskripsi menjadi array kata
                                $words = explode(' ', $tahap->deskripsi);
                                $chunks = array_chunk($words, 10); // Memecah menjadi potongan 15 kata
                            @endphp

                            <td>

                                @foreach ($chunks as $chunk)
                                    <div>{{ implode(' ', $chunk) }}</div> <!-- Menampilkan potongan kata dalam div baru -->
                                @endforeach
                            </td>
                            <td class="text-center">{{ $tahap->mulai }}</td>
                            <td class="text-center">{{ $tahap->selesai }}</td>
                            <td>
                                <a href="{{ route('tahapan.edit', $tahap->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('tahapan.destroy', $tahap->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus tahapan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
