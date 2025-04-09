<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 20px;
            color: white;
        }
        .sidebar a {
            color: #ffffff;
            display: block;
            padding: 10px 0;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex: 1;
            padding: 30px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4>Asset PIKSI</h4>
        <hr>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('kategori.index') }}">Kategori Aset</a>
        <a href="{{ route('aset.index') }}">Manajemen Aset</a>
        <a href="{{ route('peminjaman.index') }}">Peminjaman</a>
        <a href="{{ route('laporan.index') }}">Laporan</a>
        <a href="{{ route('logout') }}">Keluar</a>
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>
