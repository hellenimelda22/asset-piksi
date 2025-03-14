@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Aset</h2>
    <a href="{{ route('aset.create') }}" class="btn btn-primary">Tambah Aset</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asets as $aset)
            <tr>
                <td>{{ $aset->kode_aset }}</td>
                <td>{{ $aset->nama_aset }}</td>
                <td>{{ $aset->kategori->nama_kategori }}</td>
                <td>{{ $aset->lokasi }}</td>
                <td>{{ $aset->kondisi }}</td>
                <td>{{ $aset->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
