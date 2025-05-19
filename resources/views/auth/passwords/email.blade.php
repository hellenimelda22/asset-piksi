@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <img src="{{ asset('images/logo_piksi.png') }}" alt="Logo Piksi" height="60">
    <h4 class="mt-3">Reset Password</h4>
</div>

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="mb-3">
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Kirim Link Reset</button>
    </div>

    <div class="mt-3 text-center">
        <a href="{{ route('login') }}">Kembali ke Login</a>
    </div>
</form>
@endsection
