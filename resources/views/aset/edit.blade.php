@extends('layouts.main')

@section('title', 'Edit Aset')

@section('content')
<div class="container mt-4">
    <h2 class="text-center fw-bold text-dark">Edit Aset</h2>
    
    <!-- Form Edit Aset -->
    <div class="card p-4 shadow-sm border-0 rounded-4">
        <form action="{{ route('aset.update', $aset->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Aset</label>
                <input type="text" class="form-control" name="kode_aset" value="{{ $aset->kode_aset }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Aset</label>
                <input type="text" class="form-control" name="nama_aset" value="{{ $aset->nama_aset }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kategori</label>
                <select class="form-select" name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}" {{ $aset->kategori_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Lokasi</label>
                <input type="text" class="form-control" name="lokasi" value="{{ $aset->lokasi }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kondisi</label>
                <select class="form-select" name="kondisi" required>
                    <option value="Baik" {{ $aset->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Rusak" {{ $aset->kondisi == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Upload Gambar</label>
                <input type="file" class="form-control" name="gambar_aset">
                @if ($aset->gambar_aset)
                    <img src="{{ asset('storage/' . $aset->gambar_aset) }}" class="mt-2" width="100">
                @endif
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-dark rounded-pill px-4">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
