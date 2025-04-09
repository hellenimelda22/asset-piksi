@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <h3>Selamat datang di Dashboard, {{ Auth::user()->name }}</h3>
    <p class="text-muted">Kelola data aset, kategori, dan peminjaman di sistem ini.</p>

    <div class="row">
        <!-- Total Aset -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-lg border-primary">
                <div class="card-body bg-info text-white rounded">
                    <h5 class="card-title text-center">Total Aset</h5>
                    <p class="card-text text-center" style="font-size: 2rem; font-weight: bold;">{{ $total_aset }}</p>
                </div>
            </div>
        </div>

        <!-- Total Kategori -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-lg border-success">
                <div class="card-body bg-success text-white rounded">
                    <h5 class="card-title text-center">Total Kategori</h5>
                    <p class="card-text text-center" style="font-size: 2rem; font-weight: bold;">{{ $total_kategori }}</p>
                </div>
            </div>
        </div>

        <!-- Total Peminjaman -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-lg border-warning">
                <div class="card-body bg-warning text-dark rounded">
                    <h5 class="card-title text-center">Total Peminjaman</h5>
                    <p class="card-text text-center" style="font-size: 2rem; font-weight: bold;">{{ $total_peminjaman }}</p>
                </div>
            </div>
        </div>

        <!-- Total Aset Baik -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-lg border-success">
                <div class="card-body bg-success text-white rounded">
                    <h5 class="card-title text-center">Total Aset Baik</h5>
                    <p class="card-text text-center" style="font-size: 2rem; font-weight: bold;">{{ $total_aset_baik }}</p>
                </div>
            </div>
        </div>

        <!-- Total Aset Rusak -->
        <div class="col-md-3 mb-4">
            <div class="card shadow-lg border-danger">
                <div class="card-body bg-danger text-white rounded">
                    <h5 class="card-title text-center">Total Aset Rusak</h5>
                    <p class="card-text text-center" style="font-size: 2rem; font-weight: bold;">{{ $total_aset_rusak }}</p>
                </div>
            </div>
        </div>
    </div>   

    <!-- Memberikan jarak antara bagian statistik dan tombol laporan -->
    <div class="mt-5"></div> <!-- Memberi jarak lebih banyak antara statistik dan laporan -->

    <!-- Tombol Cetak Laporan dalam Card -->
    <div class="card shadow-lg mt-5">
        <div class="card-body">
            <h5 class="card-title text-center">Cetak Laporan</h5>
            <p class="text-center text-muted">Pilih jenis laporan yang ingin dicetak</p>

            <div class="d-flex justify-content-center gap-3">
                <!-- Tombol untuk mencetak laporan aset dan peminjaman -->
                <a href="{{ route('laporan.cetakPDF') }}" class="btn btn-success btn-lg">Laporan Aset & Peminjaman</a>

                <!-- Tombol untuk mencetak laporan hanya aset -->
                <a href="{{ route('laporan.aset.pdf') }}" class="btn btn-primary btn-lg">Laporan Aset</a>

                <!-- Tombol untuk mencetak laporan hanya peminjaman -->
                <a href="{{ route('laporan.peminjaman.pdf') }}" class="btn btn-info btn-lg">Laporan Peminjaman</a>
            </div>
        </div>
    </div>

</div>
@endsection
