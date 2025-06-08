@extends('layouts.app')

@section('title', 'Detail Aset')

@push('styles')
<style>
    .label-title {
        font-weight: 600;
        color: #444;
    }
    .card-detail th {
        width: 200px;
        color: #555;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    <h4 class="mb-4 fw-bold">Detail Aset</h4>

    <div class="card shadow-sm card-detail">
        <div class="card-body">
            <div class="row">
                {{-- Kolom Info --}}
                <div class="col-md-7">
                    <table class="table table-borderless">
                        <tr>
                           <th>Kode Aset</th>
                           <td>{{ $aset->kode_aset }}</td>
                        </tr>
                        <tr>
                            <th>Nama Aset</th>
                            <td>{{ $aset->nama_aset }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $aset->kategori->nama_kategori ?? '-' }}</td>
                        </tr>

                        {{-- Tampilkan Luas jika Bangunan (4) atau Lahan (8) --}}
                        @if (in_array($aset->kategori_id, [4, 8]))
                        <tr>
                            <th>Luas (m²)</th>
                            <td>{{ $aset->luas ?? '-' }}</td>
                        </tr>
                        @endif

                        <tr>
                            <th>Status</th>
                            <td><span class="badge bg-secondary">{{ $aset->status }}</span></td>
                        </tr>
                        <tr>
                            <th>Kondisi</th>
                            <td>
                                <span class="badge bg-{{ 
                                    $aset->kondisi == 'Baik' ? 'success' :
                                    ($aset->kondisi == 'Rusak Ringan' ? 'warning' :
                                    ($aset->kondisi == 'Rusak Berat' ? 'danger' :
                                    ($aset->kondisi == 'Dalam Perbaikan' ? 'info' : 'primary')))
                                }}">{{ $aset->kondisi }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ $aset->lokasi }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Perolehan</th>
                            <td>{{ $aset->tahun_perolehan }}</td>
                        </tr>
                    </table>
                </div>

                {{-- Kolom Gambar --}}
                <div class="col-md-5 text-center">
                    @if($aset->gambar_aset && file_exists(public_path($aset->gambar_aset)))
                        <img src="{{ asset($aset->gambar_aset) }}" alt="Gambar Aset" class="img-thumbnail" style="max-width: 50%; height: auto;">
                    @else
                        <div class="text-muted fst-italic mt-4">Belum ada gambar aset</div>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('aset.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
