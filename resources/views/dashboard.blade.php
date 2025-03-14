@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard</h2>
    
    <!-- Statistik Jumlah -->
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-info text-white p-3">
                <h4>Total Aset</h4>
                <h2>{{ $total_aset }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white p-3">
                <h4>Total Kategori</h4>
                <h2>{{ $total_kategori }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white p-3">
                <h4>Peminjaman Berlangsung</h4>
                <h2>{{ $total_peminjaman }}</h2>
            </div>
        </div>
    </div>

    <!-- Grafik Ringkasan Kondisi Aset -->
    <div class="mt-4">
        <canvas id="asetChart"></canvas>
    </div>
</div>

<!-- Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('asetChart').getContext('2d');
    var asetChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Baik', 'Rusak'],
            datasets: [{
                data: [{{ $aset_baik }}, {{ $aset_rusak }}],
                backgroundColor: ['#28a745', '#dc3545']
            }]
        }
    });
</script>
@endsection
