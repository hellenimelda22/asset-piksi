@extends('layouts.app')

@section('content')
    <h3>Data Peminjaman Aset</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('laporan.peminjaman') }}" class="row g-3 mb-3">
        <div class="col-md-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="">-- Semua Status --</option>
                <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
            <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-control" value="{{ request('nama_peminjam') }}" placeholder="Cari nama...">
        </div>

        <div class="col-md-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="{{ request('tanggal_pinjam') }}">
        </div>

        <div class="col-md-3 d-flex align-items-end gap-2">
            <button class="btn btn-primary w-100">Filter</button>
            <a href="{{ route('laporan.peminjaman.pdf', request()->all()) }}" target="_blank" class="btn btn-success w-100">Cetak PDF</a>
        </div>
    </form>

    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">Tambah Data Peminjaman</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjaman as $item)
                <tr>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td>{{ $item->aset ? $item->aset->kode_aset : '-' }}</td>
                    <td>{{ $item->aset ? $item->aset->nama_aset : '-' }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>
                        @if ($item->status === 'Dikembalikan')
                            {{ $item->tanggal_kembali }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($item->status === 'Dipinjam')
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        @else
                            <span class="badge bg-success">Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        @if ($item->status === 'Dipinjam')
                            <form action="{{ route('peminjaman.kembalikan', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">Konfirmasi Pengembalian</button>
                            </form>
                        @else
                            <span class="text-muted">Sudah dikembalikan</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
