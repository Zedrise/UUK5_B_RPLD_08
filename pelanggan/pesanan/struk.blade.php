<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Struk - {{ $order->kode_tiket }}</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 14px;
      background-color: #f9fafb;
      color: #333;
      margin: 20px;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      padding: 25px 35px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    h3.center {
      text-align: center;
      font-size: 1.8rem;
      font-weight: 700;
      color: #008148;
      margin-bottom: 25px;
      letter-spacing: 1px;
      text-shadow: 0 1px 3px rgba(0, 129, 72, 0.4);
    }

    p {
      margin: 8px 0;
      font-size: 1rem;
    }

    p strong {
      color: #008148;
      font-weight: 600;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      margin-top: 20px;
      font-size: 1rem;
    }

    thead tr th {
      text-align: left;
      padding-bottom: 8px;
      color: #555;
      border-bottom: 2px solid #e2e8f0;
    }

    tbody tr {
      background: #f1f6f4;
      border-radius: 12px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      transition: background 0.3s ease;
    }

    tbody tr:hover {
      background: #def0e3;
    }

    tbody td {
      padding: 12px 10px;
      vertical-align: middle;
      border: none;
      color: #444;
    }

    tbody td:first-child {
      font-weight: 600;
      color: #006837;
    }

    tbody td small {
      display: block;
      font-size: 0.85rem;
      color: #666;
      margin-top: 4px;
    }

    .total {
      margin-top: 25px;
      font-weight: 700;
      font-size: 1.3rem;
      text-align: right;
      color: #008148;
      letter-spacing: 0.05em;
      text-shadow: 0 1px 2px rgba(0, 129, 72, 0.3);
    }

    p.center {
      text-align: center;
      margin-top: 40px;
      font-weight: 600;
      color: #444;
      font-size: 1.1rem;
      letter-spacing: 0.02em;
    }

    @media (max-width: 480px) {
      body {
        margin: 10px;
        font-size: 13px;
      }

      .container {
        padding: 20px 20px;
      }

      h3.center {
        font-size: 1.5rem;
        margin-bottom: 20px;
      }

      table {
        font-size: 0.9rem;
      }

      tbody td {
        padding: 10px 6px;
      }

      .total {
        font-size: 1.1rem;
      }

      p.center {
        font-size: 1rem;
        margin-top: 30px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h3 class="center">STRUK PEMESANAN</h3>
    <p><strong>Kode:</strong> {{ $order->kode_tiket }}</p>
    <p><strong>Pelanggan:</strong> {{ $order->user->name }}</p>
    <p><strong>Tanggal:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>

    <table>
      <thead>
        <tr>
          <th>Kereta</th>
          <th>Kelas</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->items as $i)
        <tr>
          <td>{{ $i->jadwal->nama_kereta }} <br><small>{{ $i->jadwal->stasiun_asal }} → {{ $i->jadwal->stasiun_tujuan }}</small></td>
          <td>{{ ucfirst($i->jadwal->kelas) }}</td>
          <td>{{ $i->jumlah }}</td>
          <td>Rp {{ number_format($i->subtotal) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <p class="total">Total Bayar: Rp {{ number_format($order->total_harga) }}</p>
    <p class="center">Terima kasih, selamat jalan!</p>
  </div>
</body>
</html>
