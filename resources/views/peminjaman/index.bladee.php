@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
<div class="card shadow">
    <div class="card-header bg-dark text-white d-flex justify-content-between">
        <h5>Daftar Peminjaman</h5>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-light btn-sm">➕ Ajukan Peminjaman</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Aset</th>
                    <th>Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->aset->nama_aset }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->tanggal_pinjam }}</td>
                        <td>{{ $p->tanggal_kembali ?? '-' }}</td>
                        <td>
                            @if ($p->status == 'Dipinjam')
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @elseif ($p->status == 'Dikembalikan')
                                <span class="badge bg-success">Dikembalikan</span>
                            @endif
                        </td>
                        <td>
                            @if ($p->status == 'Dipinjam')
                                <form action="{{ route('peminjaman.kembalikan', $p->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success btn-sm">✅ Kembalikan</button>
                                </form>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>✔ Selesai</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
