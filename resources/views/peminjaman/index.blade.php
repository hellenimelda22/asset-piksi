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

{{-- Filter --}}
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
                <button type="submit" class="btn btn-outline-primary w-100">
                    <i class="bi bi-filter-circle me-1"></i> Filter
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Tabel --}}
<div class="card shadow-sm">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-sm table-striped table-borderless align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th style="background-color:#cce3ff;">No</th>
                        <th style="background-color:#cce3ff;">Nama Peminjam</th>
                        <th style="background-color:#cce3ff;">Kode Aset</th>
                        <th style="background-color:#cce3ff;">Nama Aset</th>
                        <th style="background-color:#cce3ff;">Tanggal Pinjam</th>
                        <th style="background-color:#cce3ff;">Tanggal Kembali</th>
                        <th style="background-color:#cce3ff;">Status</th>
                        <th style="background-color:#cce3ff;">Bukti</th>
                        <th style="background-color:#cce3ff;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjaman as $item)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $item->nama_peminjam ?? '-' }}</td>
                            <td>{{ $item->aset->kode_aset ?? 'Aset Dihapus' }}</td>
                            <td class="text-start">{{ $item->aset->nama_aset ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                            <td>
                                @if ($item->status === 'Dikembalikan')
                                    {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}
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
                                @if ($item->bukti && $item->bukti->file_bukti)
                                    <a href="{{ asset('bukti_peminjaman/' . $item->bukti->file_bukti) }}" target="_blank" class="btn btn-sm btn-primary">Lihat Bukti</a>
                                @else
                                    <form action="{{ route('bukti.store') }}" method="POST" enctype="multipart/form-data" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="peminjaman_id" value="{{ $item->id }}">
                                        <input type="file" name="file_bukti" accept=".pdf,.jpg,.jpeg,.png" id="file-bukti-{{ $item->id }}" style="display: none;" onchange="this.form.submit()">
                                        <label for="file-bukti-{{ $item->id }}" class="btn btn-sm btn-warning">Upload Bukti</label>
                                    </form>
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
                            <td colspan="9" class="text-center text-muted">Tidak ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Pagination --}}
<div class="mt-3">
    {{ $peminjaman->withQueryString()->links() }}
</div>

@endsection
