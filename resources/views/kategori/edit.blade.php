<!-- resources/views/kategori/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Edit Kategori Aset')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 fw-bold ">Edit Kategori Aset</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" 
                        class="form-control @error('nama_kategori') is-invalid @enderror" 
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>

                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
