<!-- resources/views/kategori/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <h3 class="mb-4">Edit Kategori Aset</h3>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" required>
        </div>
        <button type="submit" class="btn btn-dark">Update</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
