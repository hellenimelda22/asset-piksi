@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <img src="{{ asset('images/logo_piksi.png') }}" alt="Logo Piksi" height="60">
    <h4 class="mt-3">Ganti Password</h4>
</div>

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-3">
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password">Password Baru</label>
        <input id="password" type="password" class="form-control" name="password" required>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password-confirm">Konfirmasi Password</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </div>
</form>
@endsection
