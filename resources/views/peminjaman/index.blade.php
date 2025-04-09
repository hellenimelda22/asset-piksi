
@extends('layouts.app')

@section('content')
    <h3>Data Peminjaman</h3>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Aset</th>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->aset->nama_aset }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_kembali }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
