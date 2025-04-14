<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aset dan Peminjaman</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 5px;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        td {
            padding: 5px;
        }

        .table-container {
            margin-bottom: 30px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Laporan Aset dan Peminjaman</h1>

    <div class="table-container">
        <h2>Data Aset</h2>
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
    </div>

    <div class="table-container">
        <h2>Data Peminjaman</h2>
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
    <td>{{ $item->user->name }}</td>
    <td>{{ $item->aset->nama_aset }}</td>
    <td>{{ date('d-m-Y', strtotime($item->tanggal_pinjam)) }}</td>
    <td>{{ date('d-m-Y', strtotime($item->tanggal_kembali)) }}</td>
    <td>{{ $item->status }}</td>
</tr>
@endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>&copy; 2025 Aset Management System | Semua Hak Dilindungi</p>
    </div>
</body>
</html>
