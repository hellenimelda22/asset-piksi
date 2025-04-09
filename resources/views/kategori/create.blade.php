<!-- resources/views/kategori/create.blade.php -->
@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <h3 class="mb-4">Tambah Kategori Aset</h3>

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-dark">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
