@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <img src="{{ asset('images/logo_piksi.png') }}" alt="Logo Piksi" height="60">
    <h4 class="mt-3">Daftar Akun Baru</h4>
</div>

<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <label for="name">Nama Lengkap</label>
        <input id="name" type="text" class="form-control" name="name" required autofocus>
    </div>

    <div class="mb-3">
        <label for="email">Email address</label>
        <input id="email" type="email" class="form-control" name="email" required>
    </div>

    <div class="mb-3">
        <label for="password">Password</label>
        <input id="password" type="password" class="form-control" name="password" required>
    </div>

    <div class="mb-3">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Daftar</button>
    </div>

    <div class="mt-3 text-center">
        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
    </div>
</form>
@endsection
