@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow rounded p-4" style="max-width: 450px; width: 100%;">
        <div class="text-center">
            <h4 class="fw-bold mb-4">Profil Pengguna</h4>

            {{-- Foto Profil --}}
            <img src="{{ asset('images/' . ($user->photo ?? 'default-user.jpg')) }}"
                alt="Foto Profil"
                class="rounded-circle shadow mb-3"
                style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #2196F3;">

            {{-- Nama & Email --}}
            <h5 class="fw-semibold">{{ $user->name }}</h5>
            <p class="text-muted mb-4">{{ $user->email }}</p>

            {{-- Tombol --}}
            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-pencil-square me-1"></i> Edit Profil
                </a>
                <a href="{{ route('profile.password') }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-key me-1"></i> Ganti Password
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
