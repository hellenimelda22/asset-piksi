<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Aset</title>
   <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 40px;
    }

    .header-wrapper {
        display: flex;
        align-items: flex-start;
        margin-bottom: 10px;
        gap: 16px;
        margin-bottom: 10px;
    }

    .header-wrapper img {
        width: 65px;

    }

    .header-title {
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

<div class="header-wrapper">
    <img src="{{ public_path('images/logo_piksi.png') }}" alt="Logo Piksi">

    <div class="header-title">
        <h4 >Laporan Aset</h4>
        <h4>POLITEKNIK PIKSI INPUT SERANG</h4>
    </div>
</div>

<hr>


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

   
</body>
</html>
