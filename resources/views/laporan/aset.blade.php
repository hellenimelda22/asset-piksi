@extends('layouts.app')

@section('title', 'Laporan Aset')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4 rounded">
        <h4 class="fw-bold text-center mb-4">Laporan Aset</h4>
        <br>
    
        {{-- Filter --}}
        <form method="GET" action="{{ route('laporan.aset') }}" class="row g-3 align-items-end mb-3">
            <div class="col-md-2">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="form-select select2">
                    <option value="">ketik atau pilih</option>
                    @foreach($kategoriList as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="nama_aset" class="form-label">Nama Aset</label>
                <select name="nama_aset" id="nama_aset" class="form-select select2">
                    <option value="">ketik atau pilih</option>
                    @foreach($asetList as $nama)
                        <option value="{{ $nama }}" {{ request('nama_aset') == $nama ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="lokasi" class="form-label">Lokasi</label>
                <select name="lokasi" id="lokasi" class="form-select select2">
                    <option value="">ketik atau pilih</option>
                    @foreach($lokasiList as $lokasi)
                        <option value="{{ $lokasi }}" {{ request('lokasi') == $lokasi ? 'selected' : '' }}>
                            {{ $lokasi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="tahun" class="form-label">Tahun Perolehan</label>
                <select name="tahun_perolehan" class="form-select form-select-sm">
                    <option value="">Semua Tahun</option>
                    @for($tahun = date('Y'); $tahun >= 1980; $tahun--)
                        <option value="{{ $tahun }}" {{ request('tahun_perolehan') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-outline-primary w-50">
                    <i class="bi bi-filter-circle me-1"></i> Filter
                </button>

                {{-- Tombol Cetak PDF: TAB BARU --}}
                <a href="{{ route('laporan.aset.pdf', request()->query()) }}" 
                   target="_blank" rel="noopener noreferrer" 
                   class="btn btn-success w-50">
                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Cetak PDF
                </a>
            </div>
        </form>

        {{-- Tabel Aset --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th class="text-left">No</th>
                        <th class="text-left">Kode Aset</th>
                        <th class="text-left">Nama Aset</th>
                        <th class="text-left">Kategori</th>
                        <th class="text-left">Tahun Perolehan</th>
                        <th class="text-left">Lokasi</th>
                        <th class="text-left">Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aset as $index => $item)
                        <tr>
                            <td>{{ $index + $aset->firstItem() }}</td>
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

      <div class="d-flex justify-content-between align-items-center mt-2">
        <div class="small text-muted">
            {{ $aset->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
    </div>


    {{-- Footer --}}
    <div class="text-center text-muted mt-5" style="font-size: 12px;">
        &copy; 2025 Aset Management System | Semua Hak Dilindungi
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "ketik atau pilih",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
