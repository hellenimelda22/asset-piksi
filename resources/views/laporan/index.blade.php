
@extends('layouts.app')

@section('title', 'Laporan Aset')

@section('content')
    <h3 class="mb-4">Laporan Aset</h3>

    <form method="GET" action="{{ route('laporan.index') }}" class="row g-3 mb-3">
        <div class="col-md-4">
            <label>Kategori</label>
            <select name="kategori" class="form-control">
                <option value="">-- Semua Kategori --</option>
                @foreach ($kategoriData as $k) <!-- Gunakan kategoriData -->
                    <option value="{{ $k->id }}" {{ request('kategori') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>Nama Aset</label>
            <input type="text" name="nama" class="form-control" value="{{ request('nama') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filter</button>
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
            @foreach ($aset as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_aset }}</td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->kondisi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
