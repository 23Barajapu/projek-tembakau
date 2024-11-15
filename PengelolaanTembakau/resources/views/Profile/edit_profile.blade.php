@extends('components.template')
@section('title')
    Profile
@endsection
@section('pages')
    Profile
@endsection
@section('title-pages')
    Profile
@endsection
@section('content')
    <style>
        .form-control {
            border: 1px solid #ccc;
            /* Ganti warna sesuai kebutuhan */
            border-radius: 0.50rem;
            /* Sesuaikan border radius */
            padding-left: 1rem
        }

        .card-body {
            border: 1px solid #ccc;
            /* Ganti warna sesuai kebutuhan */

            /* Sesuaikan border radius */
            padding-left: 1rem
        }
    </style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white text-center">
                        <h3>Edit Profile</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat"
                                    class="form-control @error('alamat') is-invalid @enderror"
                                    value="{{ old('alamat', $user->alamat) }}" required>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" id="kota" name="kota" class="form-control"
                                    value="{{ old('kota', $user->kota) }}" required>
                                @error('kota')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="telepon">Telepon</label>
                                <input type="text" name="telepon"
                                    class="form-control @error('telepon') is-invalid @enderror"
                                    value="{{ old('telepon', $user->telepon) }}" required>
                                @error('telepon')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
                            <a href="{{ route('profile.show') }}" class="btn btn-secondary btn-block">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
