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
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card shadow">
                    <div class="card-header bg-secondary text-white text-center">
                        <h3>Profile</h3>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Name:</strong>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Alamat:</strong>
                            <p>{{ $user->alamat }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Kota:</strong>
                            <p>{{ $user->kota }}</p>
                        </div>
                        <div class="mb-3">
                            <strong>Telepon:</strong>
                            <p>{{ $user->telepon }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block w-100">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
