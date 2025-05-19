<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Aset & Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 40px;
            position: relative;
            min-height: 100%;
        }

        .header {
            width: 100%;
            display: table;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid black;
        }

        .logo {
            display: table-cell;
            width: 100px;
            vertical-align: middle;
        }

        .logo img {
            width: 80px;
        }

        .title {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }

        .title h3 {
            margin: 0;
            font-size: 18px;
        }

        .title h4 {
            margin: 0;
            font-size: 14px;
        }

        h5 {
            font-size: 14px;
            margin-top: 30px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 12px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th {
            background-color: #f2f2f2;
        }

        th, td {
            padding: 6px;
            text-align: left;
        }

        .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo">
            <img src="{{ public_path('images/logo_piksi.png') }}" alt="Logo">
        </div>
        <div class="title">
            <h3>Laporan Gabungan Aset & Peminjaman</h3>
            <h4>POLITEKNIK PIKSI INPUT SERANG</h4>
        </div>
    </div>

    <h5>Data Aset</h5>
    <table>
        <thead>
            <tr>
                <th>ID Aset</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aset as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_aset }}</td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->lokasi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h5>Data Peminjaman</h5>
    <table>
        <thead>
            <tr>
                <th>ID Peminjaman</th>
                <th>Nama Peminjam</th>
                <th>Aset yang Dipinjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td>{{ $item->aset->nama_aset ?? 'N/A' }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tanggal_pinjam)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tanggal_kembali)) }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>&copy; 2025 Aset Management System | Semua Hak Dilindungi</p>
    </div>

</body>
</html>
