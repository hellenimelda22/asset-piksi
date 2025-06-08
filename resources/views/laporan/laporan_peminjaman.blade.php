@extends('layouts.app')

@section('title', 'Laporan Peminjaman Aset')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4 rounded">
        <h4 class="fw-bold text-center mb-4">Laporan Peminjaman Aset</h4>
        <br>

        {{-- Filter --}}
        <form method="GET" action="{{ route('laporan.peminjaman') }}" class="row g-3 align-items-end mb-4">
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
                <button type="submit" class="btn btn-outline-primary w-50">
                    <i class="bi bi-filter-circle me-1"></i> Filter
                </button>
                <a href="{{ route('laporan.peminjaman.pdf', request()->query()) }}" class="btn btn-success w-50" target="_blank">
                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Cetak PDF
                </a>
            </div>
        </form>

        {{-- Tabel --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary text-left">
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Nama Aset</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($peminjaman as $index => $item)
                        <tr class="text-left">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_peminjam }}</td>
                            <td>{{ $item->aset->nama_aset ?? '-' }}</td>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Footer --}}
    <div class="text-center text-muted mt-4" style="font-size: 12px;">
        &copy; 2025 Aset Management System | Semua Hak Dilindungi
    </div>
</div>
@endsection
