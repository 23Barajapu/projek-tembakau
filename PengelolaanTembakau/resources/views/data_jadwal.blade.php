@extends('components.template')
@section('title')
    Jadwal
@endsection
@section('pages')
    Jadwal
@endsection
@section('title-pages')
    Jadwal
@endsection
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class=" mb-4">Data Jadwal Lahan</h4>
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-4">Tambah Jadwal</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($jadwals->isEmpty())
            <div class="alert alert-info">
                Data sedang tidak tersedia, silakan tambahkan data.
            </div>
        @else
            <div class="row">
                @foreach ($jadwals as $jadwal)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <strong>Nama Lahan:</strong> {{ $jadwal->lahan->nama_lahan }}<br>
                                <strong>Tanggal Tanam:</strong>
                                {{ date('d F Y', strtotime($jadwal->tanggal_tanam)) }}<br>
                                <strong>Pupuk:</strong> {{ $jadwal->pupuk }}<br>
                                <strong>Bibit:</strong> {{ $jadwal->bibit }}<br>
                                <strong>Ukuran:</strong> {{ $jadwal->lahan->luas_lahan }} Hektar<br>
                                <strong>Prediksi Jumlah Panen:</strong> {{ $jadwal->lahan->luas_lahan * 8000 }} kg<br>

                                <button class="btn btn-info btn-sm mt-2"
                                    onclick="toggleKegiatan({{ $loop->index }})">Selengkapnya</button>
                                <div class="kegiatan mt-2" id="kegiatan-{{ $loop->index }}" style="display: none;">
                                    @foreach ($tahapan as $tahap)
                                        @php
                                            // Menghitung tanggal mulai dan selesai tahapan berdasarkan tanggal_tanam
                                            $tanggalMulai = \Carbon\Carbon::parse($jadwal->tanggal_tanam)->addDays(
                                                $tahap->mulai,
                                            );
                                            $tanggalSelesai = \Carbon\Carbon::parse($jadwal->tanggal_tanam)->addDays(
                                                $tahap->selesai,
                                            );
                                        @endphp
                                        <strong>{{ $loop->iteration }}. {{ $tahap->nama_tahap }}:</strong>
                                        <br>
                                        <strong>Tanggal:</strong> {{ $tanggalMulai->format('d F Y') }} -
                                        {{ $tanggalSelesai->format('d F Y') }}<br>
                                    @endforeach
                                </div>
                                <button class="btn btn-warning btn-sm mt-2"
                                    onclick="window.location='{{ route('jadwal.edit', $jadwal->id) }}'">Edit</button>

                                <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mt-2"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</button>
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        function toggleKegiatan(index) {
            const kegiatanDiv = document.getElementById(`kegiatan-${index}`);
            kegiatanDiv.style.display = kegiatanDiv.style.display === 'none' ? 'block' : 'none';
        }

        function editJadwal(index) {
            alert(`Edit jadwal ${index}`);
        }

        function deleteJadwal(index) {
            alert(`Hapus jadwal ${index}`);
        }
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
@endsection
