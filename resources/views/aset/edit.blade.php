@extends('layouts.app')

@section('title', 'Edit Aset')

@push('styles')
<style>
    #tahun_perolehan {
        width: 160px;
        font-size: 14px;
        padding: 6px 8px;
        height: auto;
    }

    select#tahun_perolehan option {
        font-size: 14px;
        padding: 4px;
    }

    body {
        overflow: visible !important;
    }

    select {
        position: relative;
        z-index: 1000;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 fw-bold">Edit Aset</h4>

<form action="{{ route('aset.update', $aset->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="hidden" name="page" value="{{ request('page') }}">

    <div class="mb-3">
        <label for="kode_aset" class="form-label">Kode Aset</label>
        <input type="text" name="kode_aset" id="kode_aset" class="form-control @error('kode_aset') is-invalid @enderror"
            value="{{ old('kode_aset', $aset->kode_aset) }}" placeholder="Masukkan kode aset">
        @error('kode_aset')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nama_aset" class="form-label">Nama Aset</label>
        <input type="text" name="nama_aset" id="nama_aset" class="form-control @error('nama_aset') is-invalid @enderror"
            value="{{ old('nama_aset', $aset->nama_aset) }}" placeholder="Masukkan nama aset">
        @error('nama_aset')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select name="kategori_id" id="kategori_id" class="form-select select2 @error('kategori_id') is-invalid @enderror" style="width: 100%;">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $kat)
                <option value="{{ $kat->id }}" {{ old('kategori_id', $aset->kategori_id) == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>
        @error('kategori_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Field Luas (muncul jika kategori_id = 4 atau 8) --}}
    <div class="mb-3 {{ in_array(old('kategori_id', $aset->kategori_id), [4, 8]) ? '' : 'd-none' }}" id="luas_field">
        <label for="luas" class="form-label">Luas (m²)</label>
        <input type="number" name="luas" id="luas" class="form-control @error('luas') is-invalid @enderror"
            value="{{ old('luas', $aset->luas) }}" placeholder="Masukkan luas aset">
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
                <option value="{{ $tahun }}" {{ old('tahun_perolehan', $aset->tahun_perolehan) == $tahun ? 'selected' : '' }}>
                    {{ $tahun }}
                </option>
            @endfor
        </select>
        @error('tahun_perolehan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Harga Beli --}}
    <div class="mb-3">
        <label for="harga_beli" class="form-label">Harga Beli (opsional)</label>
        <input type="number" name="harga_beli" id="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror"
            value="{{ old('harga_beli', $aset->harga_beli) }}" placeholder="Contoh: 5000000" step="1000" min="0">
        @error('harga_beli')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input type="text" name="lokasi" id="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
            value="{{ old('lokasi', $aset->lokasi) }}" placeholder="Masukkan lokasi aset">
        @error('lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="kondisi" class="form-label">Kondisi</label>
        @php $selected = old('kondisi', $aset->kondisi ?? '') @endphp
        <select name="kondisi" id="kondisi" class="form-select @error('kondisi') is-invalid @enderror">
            <option value="Baik" {{ $selected == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak Ringan" {{ $selected == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
            <option value="Rusak Berat" {{ $selected == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
            <option value="Dalam Perbaikan" {{ $selected == 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
            <option value="Aktif" {{ $selected == 'Aktif' ? 'selected' : '' }}>Aktif</option>
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
        <i class="bi bi-pencil-square me-2"></i> Update
    </button>
    <a href="{{ route('aset.index', ['page' => request('page')]) }}" class="btn btn-secondary px-4 py-2 ms-2">
        <i class="bi bi-arrow-left-circle-fill me-2"></i> Kembali
    </a>
</form>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

        toggleLuasField(); // Jalankan saat load
        $('#kategori_id').on('change', toggleLuasField); // Jalankan saat pilihan berubah
    });
</script>
@endpush

@endsection
