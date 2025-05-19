@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f5f5f5;
    }

    .container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', sans-serif;
    }

    h3 {
        color: #2c3e50;
        border-bottom: 2px solid #ddd;
        padding-bottom: 10px;
    }

    h4 {
        margin-top: 30px;
        color: #34495e;
    }

    .btn {
        padding: 10px 18px;
        background-color: #3498db;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
        margin-bottom: 20px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #2980b9;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        margin-bottom: 40px;
    }

    th {
        background-color: #3498db;
        color: #fff;
        padding: 12px;
        text-align: left;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    tr:hover {
        background-color: #f0f8ff;
    }

    .footer {
        margin-top: 40px;
        font-size: 14px;
        color: #888;
        text-align: center;
    }
</style>

<div class="container">
    <h3>Laporan Gabungan Aset & Peminjaman</h3>

    @if (!isset($isPdf) || !$isPdf)
        <a href="{{ route('laporan.gabungan.pdf') }}" class="btn">Cetak PDF Gabungan</a>
    @endif

    <h4>Data Aset</h4>
    <table>
        <thead>
            <tr>
                <th>ID Aset</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aset as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_aset }}</td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->lokasi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Data Peminjaman</h4>
    <table>
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>Nama Peminjam</th>
                <th>Aset yang Dipinjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td>{{ $item->aset ? $item->aset->nama_aset : '-' }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tanggal_pinjam)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tanggal_kembali)) }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        &copy; 2025 Aset Management System | Semua Hak Dilindungi
    </div>
</div>
@endsection
