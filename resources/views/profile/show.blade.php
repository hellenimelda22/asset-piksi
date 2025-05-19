@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded">
                <div class="card-body text-center">
                    <h3 class="mb-4">Profil Pengguna</h3>

                    {{-- Foto Profil --}}
                    <img src="{{ asset('images/' . ($user->photo ?? 'default-user.jpg')) }}"
                         alt="Foto Profil"
                         class="rounded-circle shadow"
                         style="width: 150px; height: 150px; object-fit: cover;">

                    <h4 class="mt-3 mb-1">{{ $user->name }}</h4>
                    <p class="text-muted">{{ $user->email }}</p>

                    {{-- Tombol Edit --}}
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
