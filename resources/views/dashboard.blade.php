@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Selamat datang, {{ auth()->user()->name }}</h4>

    <!-- Statistik Ringkas -->
    <div class="row">
        @php
            $stats = [
                ['title' => 'Total Aset', 'value' => $totalAset, 'color' => 'primary'],
                ['title' => 'Total Kategori', 'value' => $totalKategori, 'color' => 'success'],
                ['title' => 'Total Peminjaman', 'value' => $totalPeminjaman, 'color' => 'info'],
                ['title' => 'Aset Dipinjam', 'value' => $totalDipinjam, 'color' => 'warning']
            ];
        @endphp

        @foreach ($stats as $stat)
        <div class="col-sm-6 col-md-3 mb-3">
            <div class="card border-left-{{ $stat['color'] }} shadow-sm h-100 py-2">
                <div class="card-body">
                    <h6 class="text-muted">{{ $stat['title'] }}</h6>
                    <h3>{{ $stat['value'] }}</h3>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Grafik dan Peminjaman -->
    <div class="row mt-4">
        <!-- Grafik Kondisi Aset -->
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-secondary text-white">Statistik Kondisi Aset</div>
                <div class="card-body">
                    <canvas id="chartKondisiAset" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Peminjaman Terbaru -->
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-dark text-white">Peminjaman Terbaru</div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    @forelse ($peminjamanTerbaru as $item)
                        <div class="mb-3">
                            <strong>{{ $item->nama_peminjam }}</strong> pinjam <em>{{ $item->aset->nama_aset }}</em><br>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }} → {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</small>
                        </div>
                        @if (!$loop->last) <hr> @endif
                    @empty
                        <p class="text-muted">Tidak ada peminjaman terbaru.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('chartKondisiAset').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Baik', 'Rusak'],
            datasets: [{
                label: 'Kondisi Aset',
                data: [{{ $asetBaik }}, {{ $asetRusak }}],
                backgroundColor: ['#198754', '#dc3545'],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
