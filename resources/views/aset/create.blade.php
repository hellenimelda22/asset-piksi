@extends('layouts.main')

@section('title', 'Tambah Aset')

@section('content')
<div class="container mt-4">
    <h2 class="text-center fw-bold text-dark">Tambah Aset Baru</h2>
    
    <!-- Form Tambah Aset -->
    <div class="card p-4 shadow-sm border-0 rounded-4">
        <form action="{{ route('aset.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Aset</label>
                <input type="text" class="form-control" name="kode_aset" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Aset</label>
                <input type="text" class="form-control" name="nama_aset" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kategori</label>
                <select class="form-select" name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Lokasi</label>
                <input type="text" class="form-control" name="lokasi" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kondisi</label>
                <select class="form-select" name="kondisi" required>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Upload Gambar</label>
                <input type="file" class="form-control" name="gambar_aset">
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-dark rounded-pill px-4">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
