@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Laporan Aset</h1>

    <form method="GET" action="{{ route('laporan.index') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control">
                <option value="">-- Semua Kategori --</option>
                @foreach($kategoriData as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="nama_aset" class="form-label">Nama Aset</label>
            <input type="text" name="nama_aset" id="nama_aset" class="form-control" placeholder="Cari nama aset" value="{{ request('nama_aset') }}">
        </div>

        <div class="col-md-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Cari lokasi" value="{{ request('lokasi') }}">
        </div>

        <div class="col-md-3">
            <label for="kondisi" class="form-label">Kondisi</label>
            <select name="kondisi" id="kondisi" class="form-control">
                <option value="">-- Semua Kondisi --</option>
                <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Rusak" {{ request('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
        </div>

        <div class="col-md-12 d-flex gap-2">
            <button class="btn btn-primary">Filter</button>
             <a href="{{ route('laporan.aset.pdf', request()->all()) }}" target="_blank"
           class="btn btn-success px-4 py-2 fw-semibold d-flex align-items-center gap-2">
            <i class="bi bi-file-earmark-pdf-fill"></i> Cetak PDF
        </a>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aset as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_aset }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->kondisi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Data aset tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <footer class="mt-4 text-center text-muted">
        © {{ date('Y') }} Aset Management System | Semua Hak Dilindungi
    </footer>
</div>
@endsection
