{{-- resources/views/tahapan/create.blade.php --}}
@extends('components.template')
@section('title', 'Tambah Tahapan')
@section('pages', 'Tambah Tahapan')
@section('title-pages', 'Tambah Tahapan')

@section('content')
    <style>
        .form-control {
            border: 1px solid #ccc;
            /* Ganti warna sesuai kebutuhan */
            border-radius: 0.50rem;
            /* Sesuaikan border radius */
            padding-left: 1rem
        }
    </style>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Tahapan Penanaman Tembakau</h2>

        <form action="{{ route('tahapan.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="tahap">Tahap</label>
                <input type="number" class="form-control" id="tahap" name="tahap" value="{{ old('tahap') }}"
                    placeholder="Masukkan Tahapan Ke Berapa" required>
                @error('tahap')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="nama_tahap">Nama Tahap</label>
                <input type="text" class="form-control" id="nama_tahap" name="nama_tahap" value="{{ old('nama_tahap') }}"
                    placeholder="Masukkan nama tahapan" required>
                @error('nama_tahap')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                    placeholder="Masukkan deskripsi dari tahapan" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="mulai">Mulai (Hari)</label>
                <input type="number" class="form-control" id="mulai" name="mulai" value="{{ old('mulai') }}"
                    placeholder="Masukkan mulai tahapan" required>
                @error('mulai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="selesai">Selesai (Hari)</label>
                <input type="number" class="form-control" id="selesai" name="selesai" value="{{ old('selesai') }}"
                    placeholder="Masukkan selesai tahapan" required>
                @error('selesai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('tahapan.show') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
