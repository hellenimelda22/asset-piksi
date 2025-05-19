<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aset</title>
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
     <h1>Laporan Aset</h1>


        <table>
            <thead>
                <tr>
                    <th>ID Aset</th>
                    <th>Nama Aset</th>
                    <th>Kategori</th>
                    <th>Kondisi</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aset as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama_aset }}</td>
                        <td>{{ $item->kategori->nama_kategori ?? 'Tidak Ada' }}</td>
                        <td>{{ $item->kondisi }}</td>
                        <td>{{ $item->lokasi }}</td>
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
