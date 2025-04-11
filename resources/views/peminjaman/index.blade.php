@extends('layouts.app')

@section('content')
    <h3>Data Peminjaman Aset</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">Tambah Data Peminjaman</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Nama Aset</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $item)
                <tr>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td>{{ $item->aset->nama_aset }}</td>
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
            @endforeach
        </tbody>
    </table>
@endsection
