{{-- resources/views/tahapan/edit.blade.php --}}
@extends('components.template')
@section('title', 'Edit Tahapan')
@section('pages', 'Edit Tahapan')
@section('title-pages', 'Edit Tahapan')

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
        <h2 class="mb-4">Edit Tahapan Penanaman Tembakau</h2>

        <form action="{{ route('tahapan.update', $tahap->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="tahap">Tahap</label>
                <input type="number" class="form-control" id="tahap" name="tahap"
                    value="{{ old('tahap', $tahap->tahap) }}" required>
                @error('tahap')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="nama_tahap">Nama Tahap</label>
                <input type="text" class="form-control" id="nama_tahap" name="nama_tahap"
                    value="{{ old('nama_tahap', $tahap->nama_tahap) }}" required>
                @error('nama_tahap')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $tahap->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="mulai">Mulai (Hari)</label>
                <input type="number" class="form-control" id="mulai" name="mulai"
                    value="{{ old('mulai', $tahap->mulai) }}" required>
                @error('mulai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="selesai">Selesai (Hari)</label>
                <input type="number" class="form-control" id="selesai" name="selesai"
                    value="{{ old('selesai', $tahap->selesai) }}" required>
                @error('selesai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('tahapan.show') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
