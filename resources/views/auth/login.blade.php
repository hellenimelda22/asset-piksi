@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <img src="{{ asset('images/logo_piksi.png') }}" alt="Logo Piksi" height="60">
    <h4 class="mt-3">Login SI-Aset</h4>
</div>

{{-- Notifikasi sukses login --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Notifikasi error login --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Validasi error lainnya --}}
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label for="email">Email</label>
        <input id="email" type="email"
               class="form-control @error('email') is-invalid @enderror"
               name="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="mb-3">
        <label for="password">Password</label>
        <input id="password" type="password"
               class="form-control @error('password') is-invalid @enderror"
               name="password" required>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>

    @if (Route::has('password.request'))
        <div class="mt-2 text-center">
            <a class="text-decoration-none text-primary" href="{{ route('password.request') }}">
                Lupa Password?
            </a>
        </div>
    @endif

    <div class="mt-3 text-center">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-decoration-none">Daftar di sini</a>
    </div>
</form>
@endsection
