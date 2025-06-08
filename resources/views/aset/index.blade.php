@extends('layouts.app')

@section('title', 'Manajemen Aset')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    thead tr {
        background-color: #a7ccf4 !important;
    }
    thead th {
        color: #212529 !important;
        font-weight: 600;
        font-size: 14px;
        height: 45px;
        text-align: center;
        border: none !important;
    }
    tbody tr:nth-child(odd) {
        background-color: #ffffff !important;
    }
    tbody tr:nth-child(even) {
        background-color: #f3f4f6 !important;
    }
    tbody td {
        background-color: inherit !important;
        font-size: 13.5px;
        vertical-align: middle;
        border: none !important;
        color: #212529 !important;
    }
    .badge {
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 20px;
    }
    .img-thumbnail-preview {
        width: 60px !important;
        height: 40px !important;
        object-fit: cover !important;
        border-radius: 5px !important;
        cursor: pointer;
        display: inline-block !important;
    }
    .luas-header {
        background-color:rgb(204, 227, 255) !important;
        color: #212529 !important;
        vertical-align: middle !important;
        height: 50px;
    }


</style>
@endpush

@section('content')
@php $showLuas = request('kategori_id') == 4 || request('kategori_id') == 8; @endphp

<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <h4 class="text-primary fw-bold mb-0">Manajemen Aset</h4>
        <div>
            <a href="{{ route('aset.create') }}" class="btn btn-sm btn-primary me-2">
                <i class="bi bi-plus-circle"></i> Tambah Aset
            </a>
            <a href="{{ route('aset.create_multiple') }}" class="btn btn-sm btn-success">
                <i class="bi bi-layers"></i> Tambah Banyak
            </a>
        </div>
    </div>

    {{-- Filter --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('aset.index') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label mb-1">Kategori</label>
                        <select name="kategori_id" class="form-select form-select-sm select2">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoriData as $kategori)
                                <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-1">Nama Aset</label>
                        <select name="nama_aset" class="form-select form-select-sm select2">
                            <option value="">Semua Aset</option>
                            @foreach($namaAsetData as $nama)
                                <option value="{{ $nama }}" {{ request('nama_aset') == $nama ? 'selected' : '' }}>
                                    {{ $nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-1">Lokasi</label>
                        <select name="lokasi" class="form-select form-select-sm select2">
                            <option value="">Semua Lokasi</option>
                            @foreach($lokasiData as $lokasi)
                                <option value="{{ $lokasi }}" {{ request('lokasi') == $lokasi ? 'selected' : '' }}>
                                    {{ $lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-1">Kondisi</label>
                        <select name="kondisi" class="form-select form-select-sm">
                            <option value="">Semua Kondisi</option>
                            <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ request('kondisi') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ request('kondisi') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            <option value="Dalam Perbaikan" {{ request('kondisi') == 'Dalam Perbaikan' ? 'selected' : '' }}>Dalam Perbaikan</option>
                            <option value="Aktif" {{ request('kondisi') == 'Altif' ? 'selected' : '' }}>Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-1">Tahun</label>
                        <select name="tahun_perolehan" class="form-select form-select-sm">
                            <option value="">Semua Tahun</option>
                            @foreach($tahunList as $tahun)
                                <option value="{{ $tahun }}" {{ request('tahun_perolehan') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-sm btn-outline-primary w-100 mt-1">
                            <i class="bi bi-filter-circle"></i> Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Aset --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body table-responsive">
            <table class="table table-sm table-striped table-borderless align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center align-middle"style="background-color:rgb(204, 227, 255); color: #212529;">No</th>
                        <th class="text-center align-middle"style="background-color:rgb(204, 227, 255); color: #212529;">Kode</th>
                        <th class="text-center align-middle"style="background-color:rgb(204, 227, 255); color: #212529;">Nama</th>
                        <th class="text-center align-middle"style="background-color:rgb(204, 227, 255); color: #212529;">Kategori</th>
                        @if($showLuas)
                        <th class="text-center align-middle" style="background-color:rgb(204, 227, 255); color: #212529;">
                            Luas (m²)<br>
                            <span class="text-muted" style="font-size: 11px;">(Bangunan & Lahan)</span>
                        </th>

                        @endif
                        <th class="text-center align-middle"style="background-color:rgb(204, 227, 255); color: #212529;">Tahun</th>
                        <th class="text-center align-middle"style="background-color:rgb(204, 227, 255); color: #212529;">Lokasi</th>
                        <th class="text-center align-middle"style="background-color:rgb(204, 227, 255); color: #212529;">Kondisi</th>
                        <th class="text-center align-middle"style="background-color:rgb(204, 227, 255); color: #212529;">Status</th>
                        <th class="text-center align-middle"style="background-color:rgb(204, 227, 255); color: #212529;">Gambar</th>
                        <th class="text-center align-middle"style="background-color:rgb(204, 227, 255); color: #212529;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aset as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration + ($aset->currentPage() - 1) * $aset->perPage() }}</td>
                        <td>{{ $item->kode_aset }}</td>
                        <td>{{ $item->nama_aset }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        @if($showLuas)
                        <td class="text-center">{{ $item->luas ?? '-' }}</td>
                        @endif
                        <td class="text-center">{{ $item->tahun_perolehan }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td class="text-center">
                            <span class="badge bg-{{ 
                                $item->kondisi == 'Baik' ? 'success' :
                                ($item->kondisi == 'Rusak Ringan' ? 'warning' :
                                ($item->kondisi == 'Rusak Berat' ? 'danger' :
                                ($item->kondisi == 'Dalam Perbaikan' ? 'info' :
                                ($item->kondisi == 'Aktif' ? 'primary' : 'secondary'))))
                            }}">{{ $item->kondisi }}</span>
                        </td>
                        <td class="text-center">{{ $item->status }}</td>
                       <td class="text-center">
                            @if($item->gambar_aset && file_exists(public_path($item->gambar_aset)))
                            <img src="{{ asset($item->gambar_aset) }}"
                                style="width: 60px; height: 40px; object-fit: cover; border-radius: 5px; cursor: pointer;"
                                data-bs-toggle="modal"
                                data-bs-target="#modalImage{{ $item->id }}"
                                alt="Gambar Aset">

                            <!-- Modal -->
                            <div class="modal fade" id="modalImage{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content p-3 text-center">
                                        <img src="{{ asset($item->gambar_aset) }}" class="img-fluid rounded shadow-sm" alt="Preview Besar">
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">-</span>
                        @endif

                        </td>
                        <td class="text-center">
                            <a href="{{ route('aset.show', $item->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('aset.edit', ['id' => $item->id, 'page' => request('page')]) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('aset.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus aset ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($aset->isEmpty())
                    <tr>
                        <td colspan="{{ $showLuas ? 11 : 10 }}" class="text-center text-muted">Tidak ada data aset ditemukan.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-2">
        <div class="small text-muted">
            {{ $aset->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2({
            width: '100%'
        });
    });
</script>
@endpush
