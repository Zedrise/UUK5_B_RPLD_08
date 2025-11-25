@extends('layouts.app')

@section('title','Detail Pesanan')

@section('content')
<style>
  h4 {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 30px;
    color: #2c3e50;
    text-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }

  p {
    font-size: 1.1rem;
    margin: 10px 0;
    color: #444;
  }

  p strong {
    color: #008148;
  }

  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 12px;
    margin-top: 20px;
    font-size: 1rem;
  }

  thead tr th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    font-weight: 700;
    padding: 12px 15px;
    text-align: center;
    border-radius: 12px 12px 0 0;
  }

  tbody tr {
    background: #f4f7fe;
    border-radius: 15px;
    box-shadow: 0 3px 8px rgba(102, 127, 255, 0.1);
    transition: background 0.3s ease;
  }

  tbody tr:hover {
    background: #dbe4fc;
  }

  tbody td {
    padding: 15px 10px;
    vertical-align: middle;
    text-align: center;
    color: #444;
    border: none;
  }

  tbody td:first-child {
    font-weight: 600;
    color: #004d40;
  }

  .btn-primary, .btn-outline-secondary {
    padding: 12px 35px;
    font-weight: 700;
    font-size: 1rem;
    border-radius: 15px;
    transition: all 0.3s ease;
    text-decoration: none;
    user-select: none;
  }

  .btn-primary {
    background: linear-gradient(135deg, #008148 0%, #00a65a 100%);
    border: none;
    color: white;
    box-shadow: 0 8px 25px rgba(0, 129, 72, 0.3);
    cursor: pointer;
  }

  .btn-primary:hover {
    background: linear-gradient(135deg, #005a36 0%, #007536 100%);
    box-shadow: 0 12px 35px rgba(0,117,54,0.5);
  }

  .btn-outline-secondary {
    background: transparent;
    border: 2px solid #6c757d;
    color: #6c757d;
    cursor: pointer;
  }

  .btn-outline-secondary:hover {
    background: #6c757d;
    color: white;
    box-shadow: 0 12px 35px rgba(108,117,125,0.5);
  }

  .btn-group {
    margin-top: 25px;
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
  }

  @media (max-width: 768px) {
    table {
      font-size: 0.9rem;
    }
    tbody td, thead tr th {
      padding: 10px 8px;
    }
    .btn-group {
      flex-direction: column;
      gap: 12px;
    }
    .btn-primary, .btn-outline-secondary {
      width: 100%;
      padding: 12px 0;
      font-size: 1.1rem;
      text-align: center;
    }
  }
</style>

<h4>Detail Pesanan — {{ $order->kode_tiket }}</h4>

<p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
<p><strong>Total:</strong> Rp {{ number_format($order->total_harga) }}</p>

<div class="table-responsive">
  <table>
    <thead>
      <tr>
        <th>Kereta</th>
        <th>Rute</th>
        <th>Jumlah</th>
        <th>Kelas</th>
        <th>Harga</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($order->items as $i)
      <tr>
        <td>{{ $i->jadwal->nama_kereta }}</td>
        <td>{{ $i->jadwal->stasiun_asal }} → {{ $i->jadwal->stasiun_tujuan }}</td>
        <td>{{ $i->jumlah }}</td>
        <td>{{ ucfirst($i->jadwal->kelas) }}</td>
        <td>Rp {{ number_format($i->harga) }}</td>
        <td>Rp {{ number_format($i->subtotal) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="btn-group">
  <a href="{{ route('pelanggan.cetak', $order->id) }}" class="btn btn-primary" role="button" aria-label="Cetak struk pesanan {{ $order->kode_tiket }}">Cetak Struk</a>
  <a href="{{ route('pelanggan.pesanan') }}" class="btn btn-outline-secondary" role="button" aria-label="Kembali ke riwayat pesanan">Kembali</a>
</div>
@endsection