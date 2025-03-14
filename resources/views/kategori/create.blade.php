@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card shadow">
    <div class="card-header bg-dark text-white">Tambah Kategori</div>
    <div class="card-body">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" required>
            </div>
            <button class="btn btn-dark">Simpan</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
