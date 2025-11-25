@extends('layouts.app')

@section('title','Riwayat Pesanan')

@section('content')
<style>
  h4 {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 25px;
    color: #2c3e50;
    text-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }
  .alert-info {
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    font-size: 1.1rem;
    padding: 20px;
  }
  table {
    font-size: 1rem;
  }
  thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    font-weight: 700;
    padding: 12px 15px;
    text-align: center;
    border-radius: 10px 10px 0 0;
  }
  tbody tr {
    transition: background 0.3s ease;
  }
  tbody tr:hover {
    background-color: #f2f7ff;
  }
  tbody td {
    vertical-align: middle;
    text-align: center;
    padding: 12px 15px;
    color: #34495e;
    border-top: 1px solid #e1e8ff;
  }
  .btn-info {
    color: #fff;
    background: #3498db;
    border: none;
    border-radius: 12px;
    padding: 6px 20px;
    font-weight: 600;
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
    transition: background 0.3s ease;
  }
  .btn-info:hover {
    background: #2c80b4;
    box-shadow: 0 8px 20px rgba(44, 128, 180, 0.6);
  }
  .btn-primary {
    color: #fff;
    background: linear-gradient(135deg, #008148 0%, #00a65a 100%);
    border: none;
    border-radius: 12px;
    padding: 6px 20px;
    font-weight: 600;
    box-shadow: 0 5px 15px rgba(0, 129, 72, 0.4);
    transition: background 0.3s ease;
  }
  .btn-primary:hover {
    background: linear-gradient(135deg, #005a36 0%, #007536 100%);
    box-shadow: 0 8px 20px rgba(0, 117, 54, 0.6);
  }
  .table-responsive {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  }
  @media (max-width: 768px) {
    thead th, tbody td {
      padding: 10px 8px;
      font-size: 0.9rem;
    }
    .btn-info, .btn-primary {
      width: 100%;
      margin-top: 5px;
    }
    tbody td {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }
    tbody td:last-child {
      flex-direction: row;
      justify-content: center;
      gap: 10px;
    }
  }
</style>

<h4>Riwayat Pesanan</h4>

@if($pesanan->isEmpty())
  <div class="alert alert-info">Belum ada riwayat pesanan.</div>
@else
  <div class="table-responsive">
    <table class="table align-middle mb-0">
      <thead>
        <tr>
          <th>Kode Tiket</th>
          <th>Total</th>
          <th>Status</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pesanan as $p)
        <tr>
          <td>{{ $p->kode_tiket }}</td>
          <td>Rp {{ number_format($p->total_harga) }}</td>
          <td>{{ ucfirst($p->status) }}</td>
          <td>{{ $p->created_at->format('d-m-Y') }}</td>
          <td>
            <a href="{{ route('pelanggan.pesanan.detail', $p->id) }}" 
               class="btn btn-info btn-sm" role="button" aria-label="Detail pesanan {{ $p->kode_tiket }}">Detail</a>

            <a href="{{ route('pelanggan.cetak', $p->id) }}" 
               class="btn btn-primary btn-sm" role="button" aria-label="Cetak struk pesanan {{ $p->kode_tiket }}">Cetak Struk</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endif
@endsection