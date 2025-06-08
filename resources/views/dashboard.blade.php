@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Selamat datang, {{ Auth::user()->name }}</h4>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif


    {{-- Kartu Statistik --}}
    <div class="row mb-4 animate__animated animate__fadeInDown animate__delay-0_6s">
        <div class="col-md-3 mb-3">
            <a href="{{ route('aset.index') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm hover-card" style="background-color: #e3f2fd;">
                    <div class="card-body">
                        <i class="fas fa-box fa-2x text-primary mb-2"></i>
                        <h6 class="text-muted">Total Aset</h6>
                        <h3>{{ $jumlahAset }}</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('kategori.index') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm hover-card" style="background-color: #e8f5e9;">
                    <div class="card-body">
                        <i class="fas fa-tags fa-2x text-success mb-2"></i>
                        <h6 class="text-muted">Total Kategori</h6>
                        <h3>{{ $jumlahKategori }}</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('peminjaman.index') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm hover-card" style="background-color: #e3f2fd;">
                    <div class="card-body">
                        <i class="fas fa-handshake fa-2x text-info mb-2"></i>
                        <h6 class="text-muted">Total Peminjaman</h6>
                        <h3>{{ $jumlahPeminjaman }}</h3>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 mb-3">
            <a href="{{ route('peminjaman.index') }}" class="text-decoration-none">
                <div class="card text-center shadow-sm hover-card" style="background-color: #fff8e1;">
                    <div class="card-body">
                        <i class="fas fa-truck-loading fa-2x text-warning mb-2"></i>
                        <h6 class="text-muted">Aset Dipinjam</h6>
                        <h3>{{ $jumlahDipinjam }}</h3>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Statistik, Kategori, Peminjaman --}}
    <div class="row animate__animated animate__fadeInUp animate__delay-1_2s">
        {{-- Statistik Kondisi Aset --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-70">
                <div class="card-header text-center bg-primary text-white">Statistik Kondisi Aset</div>
                <div class="card-body d-flex justify-content-center align-items-center" style="height: 280px;">
                    <canvas id="kondisiChart" style="width: 100%; max-width: 130px;"></canvas>
                </div>
            </div>
        </div>

        {{-- Jumlah Aset per Kategori --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header text-center bg-info text-white">Jumlah Aset per Kategori</div>
                <div class="card-body" style="padding: 1rem 1.25rem; height: 280px; overflow-y: auto;">
                    @forelse($jumlahAsetPerKategori as $kategori => $jumlah)
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span>{{ $kategori }}</span>
                            <span class="circle-count">{{ $jumlah }}</span>
                        </div>
                    @empty
                        <p class="text-muted text-center">Tidak ada data kategori.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Peminjaman Terbaru --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header text-center bg-dark text-white">Peminjaman Terbaru</div>
                <div class="card-body" style="height: 280px; overflow-y: auto;">
                    @forelse ($peminjamanTerbaru as $peminjaman)
                        <div class="mb-3 border-bottom pb-2">
                            <strong>{{ $peminjaman->nama_peminjam ?? 'Tidak ada nama' }}</strong> pinjam 
                            <em>{{ $peminjaman->aset ? $peminjaman->aset->nama_aset : 'Aset dihapus' }}</em>
                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }} 
                            &rarr; 
                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}
                        </div>
                    @empty
                        <p class="text-muted text-center">Belum ada peminjaman.</p>
                    @endforelse
                </div>
            </div>
        </div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('kondisiChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Dalam Perbaikan', 'Aktif'],
            datasets: [{
                data: [
                    {{ $jumlahBaik }},
                    {{ $jumlahRusakRingan }},
                    {{ $jumlahRusakBerat }},
                    {{ $jumlahDalamPerbaikan }},
                    {{ $jumlahAktif }}
                ],
                backgroundColor: [
                    '#198754', // Baik
                    '#ffc107', // Rusak Ringan
                    '#dc3545', // Rusak Berat
                    '#5CE1E6', // Dalam Perbaikan
                    '#0d6efd'  // Aktif
                ],
                borderWidth: 1,
                hoverOffset: 8
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
{{-- Animate.css --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

{{-- Custom Style --}}
<style>
    .hover-card {
        transition: all 0.3s ease-in-out;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        cursor: pointer;
    }
    .card .card-body h3 {
        font-weight: bold;
        font-size: 24px;
    }
    .card .card-body h6 {
        font-size: 13px;
        letter-spacing: 0.5px;
    }
    .card-header {
        font-size: 14px;
        font-weight: 600;
        padding: 0.6rem;
    }
    .circle-count {
        background-color: #2196F3;
        color: #fff;
        font-weight: 600;
        font-size: 13px;
        width: 26px;
        height: 26px;
        line-height: 26px;
        border-radius: 50%;
        text-align: center;
        display: inline-block;
    }
    .animate__delay-0_6s {
        animation-delay: 0.6s;
    }
    .animate__delay-1_2s {
        animation-delay: 1.2s;
    }
</style>
@endsection
