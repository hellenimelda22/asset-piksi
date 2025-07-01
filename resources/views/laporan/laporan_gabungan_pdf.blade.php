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
            width: 65px;
        }

        .title {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }

        .title h4 {
            margin: 0;
            font-size: 14px;
        }

        h5 {
            font-size: 14px;
            margin-top: 30px;
            margin-bottom: 10px;
            text-align: center;
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
            background-color: rgb(221, 221, 221);
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
            <h4>LAPORAN ASET & PEMINJAMAN</h4>
            <h4>POLITEKNIK PIKSI INPUT SERANG</h4>
        </div>
    </div>

    <h5>Data Aset</h5>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Tahun Perolehan</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aset as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode_aset }}</td>
                    <td>{{ $item->nama_aset }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->tahun_perolehan }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->kondisi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h5>Data Peminjaman</h5>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Nama Aset</th>
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
                    <td>{{ $item->aset->nama_aset ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td>
                        {{ $item->status === 'Dikembalikan' && $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') : '-' }}
                    </td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
