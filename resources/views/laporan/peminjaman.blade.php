@extends('layouts.app')

@section('content')
    <h2>Laporan Peminjaman Aset</h2>

    <form method="GET" action="{{ route('laporan.peminjaman') }}" class="row g-3 mb-3">
        <div class="col-md-4">
            <label>Nama Peminjam</label>
            <input type="text" name="user" class="form-control" value="{{ request('user') }}">
        </div>
        <div class="col-md-3">
            <label>Dari Tanggal</label>
            <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
        </div>
        <div class="col-md-3">
            <label>Sampai Tanggal</label>
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
        </div>
        <div class="col-md-2">
            <label>&nbsp;</label>
            <div>
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('laporan.peminjaman.pdf', request()->all()) }}" target="_blank" class="btn btn-success">Cetak PDF</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Aset</th>
                <th>Peminjam</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjaman as $pinjam)
                <tr>
                    <td>{{ $pinjam->aset->nama_aset }}</td>
                    <td>{{ $pinjam->user->name }}</td>
                    <td>{{ $pinjam->tanggal_pinjam }}</td>
                    <td>{{ $pinjam->tanggal_kembali }}</td>
                    <td>{{ $pinjam->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data peminjaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
