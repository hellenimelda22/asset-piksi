<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman Aset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 40px;
        }

        .header-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .header-wrapper img {
            width: 65px;
            margin-right: 15px;
        }

        .header-title {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            line-height: 1.3;
            text-align: center;
            margin-top: -50px
        }

        .header-title h4 {
            margin: 0;
            font-size: 14px;
            text-transform: uppercase;
        }


        hr {
            border: 1px solid #000;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color:rgb(221, 221, 221);
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 30px;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="header-wrapper">
        <img src="{{ public_path('images/logo_piksi.png') }}" alt="Logo">
        <div class="header-title">
            <h4>LAPORAN PEMINJAMAN</h4>
            <h4>POLITEKNIK PIKSI INPUT SERANG</h4>
        </div>
    </div>

    <hr>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Aset yang Dipinjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_peminjam }}</td>
                    <td>{{ $item->aset->nama_aset ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td>
                        {{ $item->status === 'Dikembalikan' && $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') : '-' }}
                    </td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        &copy; 2025 Aset Management System | Semua Hak Dilindungi
    </div>

</body>
</html>
