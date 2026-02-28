<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>

    <style>
        body {
            font-family: Arial;
            font-size: 12px;
            padding: 25px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid black;
            margin-bottom: 15px;
        }

        .header h2 {
            margin: 0;
        }

        .info {
            margin-bottom: 10px;
        }

        .stat {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .box {
            flex: 1;
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #eee;
        }

        .footer {
            width: 100%;
            margin-top: 40px;
        }

        .ttd {
            width: 250px;
            float: right;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>LAPORAN PEMINJAMAN BUKU</h2>
    <p>Lumina Library</p>
</div>

<div class="info">
    <p>Tanggal : {{ $tanggal }}</p>
</div>

<div class="stat">
    <div class="box">
        <b>Borrowed</b><br>{{ $borrowed }}
    </div>
    <div class="box">
        <b>Returned</b><br>{{ $returned }}
    </div>
    <div class="box">
        <b>Overdue</b><br>{{ $overdue }}
    </div>
</div>

<table>
    <tr>
        <th>No</th>
        <th>Nama Siswa</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
    </tr>

    @foreach($data as $i => $item)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $item->siswa->nama ?? '-' }}</td>
        <td>{{ $item->buku->judul ?? '-' }}</td>
        <td>{{ $item->tanggal_peminjaman }}</td>
        <td>{{ $item->tanggal_pengembalian ?? '-' }}</td>
        <td>{{ ucfirst($item->status_pengembalian) }}</td>
    </tr>
    @endforeach

</table>

<div class="footer">
    <div class="ttd">
        <p>Mengetahui,</p>
        <br><br><br>
        <p>_____________________</p>
    </div>
</div>

</body>
</html>