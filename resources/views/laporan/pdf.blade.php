<!DOCTYPE html>
<html>
<head>
    <title>Laporan Aset</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Laporan Aset</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aset as $a)
                <tr>
                    <td>{{ $a->kode_aset }}</td>
                    <td>{{ $a->nama_aset }}</td>
                    <td>{{ $a->kategori->nama_kategori }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Laporan Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Aset</th>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $p)
                <tr>
                    <td>{{ $p->aset->nama_aset }}</td>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->tanggal_pinjam }}</td>
                    <td>{{ $p->tanggal_kembali ?? '-' }}</td>
                    <td>{{ $p->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
