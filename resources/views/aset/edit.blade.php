@extends('layouts.app')

@section('content')
    <h2>Edit Aset</h2>

    <form action="{{ route('aset.update', $aset->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode_aset" class="form-label">Kode Aset</label>
            <input type="text" name="kode_aset" class="form-control" value="{{ $aset->kode_aset }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_aset" class="form-label">Nama Aset</label>
            <input type="text" name="nama_aset" class="form-control" value="{{ $aset->nama_aset }}" required>
        </div>
        <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach ($kategori as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $aset->kategori_id ? 'selected' : '' }}>
                        {{ $item->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ $aset->lokasi }}" required>
        </div>
        <div class="mb-3">
            <label for="kondisi" class="form-label">Kondisi</label>
            <select name="kondisi" class="form-control" required>
                <option value="Baik" {{ $aset->kondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Rusak" {{ $aset->kondisi == 'Rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Tersedia" {{ $aset->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="Dipinjam" {{ $aset->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="gambar_aset" class="form-label">Ganti Gambar (opsional)</label>
            <input type="file" name="gambar_aset" class="form-control">
            @if ($aset->gambar_aset)
                <small>Gambar saat ini: {{ $aset->gambar_aset }}</small>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('aset.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
