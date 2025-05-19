@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Profil Pengguna</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Dibuat Pada:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
        </div>
    </div>
</div>
@endsection
