@extends('layouts.app')

@section('title', 'Tambah Aset')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 fw-bold">Tambah Aset</h4>

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

    {{-- FIELD LUAS (muncul kalau kategori ID = 4 atau 8) --}}
    <div class="mb-3 d-none" id="luas_field">
        <label for="luas" class="form-label">Luas (m²)</label>
        <input type="number" name="luas" id="luas" class="form-control @error('luas') is-invalid @enderror" 
            value="{{ old('luas') }}" placeholder="Masukkan luas aset (khusus Bangunan atau Lahan)">
        @error('luas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="tahun_perolehan" class="form-label">Tahun Perolehan</label>
        <select name="tahun_perolehan" id="tahun_perolehan" class="form-select @error('tahun_perolehan') is-invalid @enderror">
            @php
                $tahunSekarang = date('Y');
                $tahunMulai = 1980;
            @endphp
            <option value="">-- Pilih Tahun --</option>
            @for($tahun = $tahunSekarang; $tahun >= $tahunMulai; $tahun--)
               <option value="{{ $tahun }}" {{ old('tahun_perolehan') == $tahun ? 'selected' : '' }}>
                    {{ $tahun }}
                </option>
            @endfor
        </select>
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
        <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror">
            <option value="">-- Pilih Kondisi --</option>
            <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak Ringan" {{ old('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
            <option value="Rusak Berat" {{ old('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
            <option value="Dalam Perbaikan" {{ old('kondisi') == 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
            <option value="Aktif" {{ old('kondisi') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
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

        function toggleLuasField() {
            const selected = $('#kategori_id').val();
            if (selected == 4 || selected == 8) {
                $('#luas_field').removeClass('d-none');
            } else {
                $('#luas_field').addClass('d-none');
                $('#luas').val('');
            }
        }

        toggleLuasField();
        $('#kategori_id').on('change', toggleLuasField);
    });
</script>
@endpush

@endsection
