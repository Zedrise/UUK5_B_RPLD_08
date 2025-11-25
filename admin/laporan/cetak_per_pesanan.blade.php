<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Pemesanan</title>

    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h3 { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
        .info-box { margin-bottom: 15px; }
        .info-box p { margin: 2px 0; }
    </style>
</head>
<body>

<h3>NOTA PEMESANAN TIKET KERETA</h3>

<div class="info-box">
    <p><strong>Kode Tiket:</strong> {{ $order->kode_tiket }}</p>
    <p><strong>Pelanggan:</strong> {{ $order->user->name }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
</div>

<table>
    <thead>
        <tr>
            <th>Nama Kereta</th>
            <th>Rute</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($order->items as $item)
        <tr>
            <td>{{ $item->jadwal->nama_kereta }}</td>
            <td>{{ $item->jadwal->stasiun_asal }} → {{ $item->jadwal->stasiun_tujuan }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h4 style="text-align:right; margin-top:10px;">
    Total: Rp {{ number_format($order->total_harga, 0, ',', '.') }}
</h4>

<p style="text-align:center; margin-top:30px;">Terima kasih telah menggunakan layanan kami</p>

</body>
</html>
