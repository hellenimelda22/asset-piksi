@extends('layouts.app')

@section('title', 'Laporan Gabungan Aset & Peminjaman')

@section('content')
<div class="container mt-4">
    <div class="card p-4 shadow-sm rounded">
        <h4 class="fw-bold text-center mb-4">Laporan Aset & Peminjaman</h4>
        <br>

        <div class="mb-3">
            <a href="{{ route('laporan.gabungan.pdf') }}" target="_blank" class="btn btn-primary">
                <i class="bi  bi-file-earmark-pdf-fill me-1"></i> Cetak PDF Gabungan
            </a>
        </div>
         
        <h5 class="fw-semibold text-center mt-4 mb-3">Data Aset</h5>
        <div class="table-responsive mb-4">
            <table class="table table-borderless table-striped align-middle">
                <thead class="table-primary text-left">
                    <tr>
                        <th>No</th>
                        <th>Kode Aset</th>
                        <th>Nama Aset</th>
                        <th>Kategori</th>
                        <th>Tahun Perolehan</th>
                        <th>Lokasi</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($aset as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kode_aset }}</td>
                            <td>{{ $item->nama_aset }}</td>
                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $item->tahun_perolehan }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->kondisi }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data aset.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h5 class="fw-semibold text-center mt-4 mb-3">Data Peminjaman</h5>
        <div class="table-responsive">
            <table class="table table-borderless table-striped align-middle">
                <thead class="table-primary text-center">
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
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
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

        <div class="text-center text-muted mt-5" style="font-size: 12px;">
            &copy; 2025 Aset Management System | Semua Hak Dilindungi
        </div>
    </div>
</div>
@endsection
