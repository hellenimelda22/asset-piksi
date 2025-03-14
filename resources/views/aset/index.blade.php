@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manajemen Aset</h2>
    <a href="{{ route('aset.create') }}" class="btn btn-primary mb-3">Tambah Aset</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asets as $aset)
            <tr>
                <td>{{ $aset->kode_aset }}</td>
                <td>{{ $aset->nama_aset }}</td>
                <td>{{ $aset->lokasi }}</td>
                <td>{{ $aset->kondisi }}</td>
                <td>{{ $aset->status }}</td>
                <td>
                    <form action="{{ route('aset.destroy', $aset->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
