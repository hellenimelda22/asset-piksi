@extends('layouts.app')

@section('title', 'Laporan Aset')

@section('content')
<div class="card shadow">
    <div class="card-header bg-dark text-white">Laporan Aset & Peminjaman</div>
    <div class="card-body">
        <form method="GET" action="{{ route('laporan.index') }}">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="nama" class="form-control" placeholder="Cari berdasarkan nama">
                </div>
                <div class="col-md-4">
                    <select name="kategori" class="form-control">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-dark">Cari</button>
                    <a href="{{ route('laporan.pdf') }}" class="btn btn-danger">Export PDF</a>
                </div>
            </div>
        </form>
        
        <hr>
        
        <h5>Daftar Aset</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aset as $a)
                    <tr>
                        <td>{{ $a->kode_aset }}</td>
                        <td>{{ $a->nama_aset }}</td>
                        <td>{{ $a->kategori->nama_kategori }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <h5>Riwayat Peminjaman</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Aset</th>
                    <th>Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($peminjaman as $p)
                    <tr>
                        <td>{{ $p->aset->nama_aset }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->tanggal_pinjam }}</td>
                        <td>{{ $p->tanggal_kembali ?? '-' }}</td>
                        <td>{{ $p->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
