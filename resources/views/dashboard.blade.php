@extends('layouts.app')

@section('content')
<div class="container-fluid animate__animated animate__fadeIn">
    <h4 class="mb-4">Selamat datang, {{ Auth::user()->name }}</h4>

    {{-- Kartu Statistik --}}
    <div class="row mb-4">
        {{-- Total Aset --}}
        <div class="col-md-3 mb-3">
            <a href="{{ route('aset.index') }}" class="text-decoration-none">
                <div class="card dashboard-box text-center hover-card shadow-sm animate__animated animate__zoomIn animate__delay-1s">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="fas fa-box fa-2x text-primary"></i>
                        </div>
                        <h6 class="text-muted">Total Aset</h6>
                        <h3>{{ $jumlahAset }}</h3>  <!-- Menampilkan jumlah aset -->
                    </div>
                </div>
            </a>
        </div>

        {{-- Total Kategori --}}
        <div class="col-md-3 mb-3">
            <a href="{{ route('kategori.index') }}" class="text-decoration-none">
                <div class="card dashboard-box text-center hover-card shadow-sm animate__animated animate__zoomIn animate__delay-2s">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="fas fa-tags fa-2x text-success"></i>
                        </div>
                        <h6 class="text-muted">Total Kategori</h6>
                        <h3>{{ $jumlahKategori }}</h3>  <!-- Menampilkan jumlah kategori -->
                    </div>
                </div>
            </a>
        </div>

        {{-- Total Peminjaman --}}
        <div class="col-md-3 mb-3">
            <a href="{{ route('peminjaman.index') }}" class="text-decoration-none">
                <div class="card dashboard-box text-center hover-card shadow-sm animate__animated animate__zoomIn animate__delay-3s">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="fas fa-handshake fa-2x text-info"></i>
                        </div>
                        <h6 class="text-muted">Total Peminjaman</h6>
                        <h3>{{ $jumlahPeminjaman }}</h3>  <!-- Menampilkan jumlah peminjaman -->
                    </div>
                </div>
            </a>
        </div>

        {{-- Aset Dipinjam --}}
        <div class="col-md-3 mb-3">
            <a href="{{ route('peminjaman.index') }}" class="text-decoration-none">
                <div class="card dashboard-box text-center hover-card shadow-sm animate__animated animate__zoomIn animate__delay-4s">
                    <div class="card-body">
                        <div class="mb-2">
                            <i class="fas fa-truck-loading fa-2x text-warning"></i>
                        </div>
                        <h6 class="text-muted">Aset Dipinjam</h6>
                        <h3>{{ $jumlahDipinjam }}</h3>  <!-- Menampilkan jumlah aset yang dipinjam -->
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- Statistik & Peminjaman Terbaru --}}
    <div class="row animate__animated animate__fadeInUp animate__delay-5s">
        <div class="col-md-6 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-secondary text-white">
                    Statistik Kondisi Aset
                </div>
                <div class="card-body d-flex justify-content-center" style="height: 220px;">
                    <canvas id="kondisiChart" style="width: 100%; max-width: 200px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-header bg-dark text-white">
                    Peminjaman Terbaru
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    @forelse ($peminjamanTerbaru as $peminjaman)
                        <div class="mb-3 border-bottom pb-2">
                        <strong>{{ $peminjaman->nama_peminjam ?? 'Tidak ada nama' }}</strong> pinjam 
                        <em>{{ $peminjaman->aset ? $peminjaman->aset->nama_aset : 'Aset dihapus' }}</em>
                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }} 
                            &rarr; 
                            {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}
                        </div>
                    @empty
                        <p class="text-muted">Belum ada peminjaman.</p>
                    @endforelse
                </div>
            </div>
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
            labels: ['Baik', 'Rusak Ringan', 'Rusak Berat'],
            datasets: [{
                data: [{{ $jumlahBaik }}, {{ $jumlahRusakRingan }}, {{ $jumlahRusakBerat }}],
                backgroundColor: ['#4CAF50', '#FFC107', '#F44336']
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
</style>
@endsection
