@extends('layouts.app')

@section('title', 'Tambah Aset')

@section('content')
<h2>Tambah Aset Baru</h2>

<form action="{{ route('aset.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="kode_aset" class="form-label">Kode Aset</label>
        <input type="text" name="kode_aset" id="kode_aset" class="form-control @error('kode_aset') is-invalid @enderror" 
            value="{{ old('kode_aset') }}" placeholder="Masukkan kode aset">
        @error('kode_aset')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nama_aset" class="form-label">Nama Aset</label>
        <input type="text" name="nama_aset" id="nama_aset" class="form-control @error('nama_aset') is-invalid @enderror" 
            value="{{ old('nama_aset') }}" placeholder="Masukkan nama aset">
        @error('nama_aset')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select name="kategori_id" id="kategori_id" class="form-select select2 @error('kategori_id') is-invalid @enderror" style="width: 100%;">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $kat)
                <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('kategori_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
         <label for="tahun_perolehan" class="form-label">Tahun Perolehan</label>
         <input type="number" name="tahun_perolehan" id="tahun_perolehan" class="form-control @error('tahun_perolehan') is-invalid @enderror" 
             value="{{ old('tahun_perolehan') }}" placeholder="Masukkan Tahun Perolehan">
          @error('tahun_perolehan')
              <div class="invalid-feedback">{{ $message }}</div>
         @enderror
    </div>

    <div class="mb-3">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror" 
            value="{{ old('lokasi') }}" placeholder="Masukkan lokasi aset">
        @error('lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="kondisi" class="form-label">Kondisi</label>
        <select name="kondisi" id="kondisi" class="form-select @error('kondisi') is-invalid @enderror">
            <option value="">-- Pilih Kondisi --</option>
            <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak" {{ old('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
        </select>
        @error('kondisi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="gambar_aset" class="form-label">Gambar Aset (opsional)</label>
        <input type="file" name="gambar_aset" id="gambar_aset" class="form-control @error('gambar_aset') is-invalid @enderror" accept="image/*">
        @error('gambar_aset')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary px-4 py-2">
        <i class="bi bi-plus-circle-fill me-2"></i> Simpan
    </button>
    <a href="{{ route('aset.index') }}" class="btn btn-secondary px-4 py-2 ms-2">
        <i class="bi bi-arrow-left-circle-fill me-2"></i> Kembali
    </a>
</form>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#kategori_id').select2({
            placeholder: "Pilih Kategori",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush

@endsection
