<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pesanan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
        h3 { text-align: center; margin-bottom: 5px; }
    </style>
</head>
<body>

<h3>LAPORAN DATA PESANAN</h3>
<p>Dicetak pada: {{ date('d-m-Y H:i') }}</p>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Kode Tiket</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $o)
        <tr>
            <td>{{ $o->id }}</td>
            <td>{{ $o->user->name }}</td>
            <td>{{ $o->kode_tiket }}</td>
            <td>Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
            <td>{{ $o->status }}</td>
            <td>{{ $o->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
