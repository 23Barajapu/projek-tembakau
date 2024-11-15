@extends('components.template')

@section('title')
    History Jadwal
@endsection

@section('pages')
    History Jadwal
@endsection

@section('title-pages')
    History Jadwal
@endsection

@section('content')
    <h5 class="mt-4">History Jadwal</h5>
    @if ($jadwalSelesai->isEmpty())
        <div class="alert alert-info">
            Data sedang tidak tersedia, silakan selesaikan jadwal terlebih dahulu.
        </div>
    @else
        <div class="table-responsive text-center">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lahan</th>
                        <th>Tanggal Tanam</th>
                        <th>Pupuk</th>
                        <th>Bibit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwalSelesai as $index => $jadwal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $jadwal->lahan->nama_lahan ?? 'Tidak ada data' }}</td>
                            <td>{{ $jadwal->tanggal_tanam->format('d F Y') }}</td>
                            <td>{{ $jadwal->pupuk }}</td>
                            <td>{{ $jadwal->bibit }}</td>
                            <td> <a href="{{ route('calendar.index', $jadwal->id) }}"
                                    class="btn btn-warning btn-sm">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
