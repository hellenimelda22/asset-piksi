@extends('layouts.app')

@section('title', 'Data Peminjaman Aset')

@section('content')

    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <h4 class="text-primary fw-bold mb-0">Data Peminjaman Aset</h4>
        <div>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle-fill me-1"></i> Tambah Peminjaman
        </a>
    </div>
</div>
    {{-- Card Filter --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('peminjaman.index') }}" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-control" value="{{ request('nama_peminjam') }}" placeholder="Cari nama peminjam">
                </div>
                <div class="col-md-3">
                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="{{ request('tanggal_pinjam') }}">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-outline-primary w-100"><i class="bi bi-filter-circle me-1"></i> Filter</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Card Tabel --}}
    <div class="card shadow-sm">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                 <table class="table table-sm table-striped table-borderless align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th class="text-center"style="background-color:rgb(204, 227, 255); color: #212529;">No</th>
                            <th class="text-center"style="background-color:rgb(204, 227, 255); color: #212529;">Nama Peminjam</th>
                            <th class="text-center"style="background-color:rgb(204, 227, 255); color: #212529;">Kode Aset</th>
                            <th class="text-center"style="background-color:rgb(204, 227, 255); color: #212529;">Nama Aset</th>
                            <th class="text-center"style="background-color:rgb(204, 227, 255); color: #212529;">Tanggal Pinjam</th>
                            <th class="text-center"style="background-color:rgb(204, 227, 255); color: #212529;">Tanggal Kembali</th>
                            <th class="text-center"style="background-color:rgb(204, 227, 255); color: #212529;">Status</th>
                            <th class="text-center"style="background-color:rgb(204, 227, 255); color: #212529;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjaman as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_peminjam ?? '-' }}</td>
                                <td>{{ $item->aset->kode_aset ?? 'Aset Dihapus' }}</td>
                                <td>{{ $item->aset->nama_aset ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    @if ($item->status === 'Dikembalikan')
                                        {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->status === 'Dipinjam')
                                        <span class="badge bg-warning text-dark">Dipinjam</span>
                                    @else
                                        <span class="badge bg-success">Dikembalikan</span>
                                    @endif
                                </td>
                                <td class="text-center">
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
                                <td colspan="8" class="text-center text-muted">Tidak ada data peminjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="mt-3">
    {{ $peminjaman->withQueryString()->links() }}
</div>

@endsection
