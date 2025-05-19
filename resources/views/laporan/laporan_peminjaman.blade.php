<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
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

        .btn-cetak {
            display: inline-block;
            padding: 8px 12px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Laporan Peminjaman</h1>


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
                        <td>{{ $item->nama_peminjam ?? 'Tidak ada nama' }}</td>
                        <td>{{ $item->aset->nama_aset ?? 'N/A' }}</td>
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
