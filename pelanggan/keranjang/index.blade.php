@extends('layouts.app')

@section('title','Keranjang Saya')

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
  }
  .card {
    border-radius: 20px;
    padding: 20px 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    background-color: #fff;
  }
  .card:hover {
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    transform: translateY(-6px);
  }
  table {
    font-size: 0.95rem;
  }
  thead th {
    border-bottom: 2px solid #dee2e6;
    color: #343a40;
    font-weight: 600;
  }
  tbody td {
    vertical-align: middle;
    color: #495057;
  }
  tbody tr:hover {
    background-color: #f8f9fa;
  }
  .btn-danger {
    border-radius: 12px;
    padding: 6px 14px;
    font-weight: 600;
    background: #dc3545;
    border: none;
    box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3);
    transition: background 0.3s ease;
  }
  .btn-danger:hover {
    background: #b02a37;
    box-shadow: 0 5px 15px rgba(176, 42, 55, 0.5);
  }
  .text-end h5 {
    font-weight: 700;
    color: #2c3e50;
    font-size: 1.4rem;
    margin-bottom: 15px;
  }
  .btn-success {
    background: linear-gradient(135deg, #008148 0%, #00a65a 100%);
    border: none;
    padding: 12px 30px;
    border-radius: 15px;
    font-weight: 700;
    font-size: 1rem;
    box-shadow: 0 8px 25px rgba(0,129,72,0.3);
    transition: background 0.3s ease;
    cursor: pointer;
  }
  .btn-success:hover {
    background: linear-gradient(135deg, #005a36 0%, #007536 100%);
    box-shadow: 0 12px 35px rgba(0,117,54,0.5);
  }

  @media (max-width: 768px) {
    .card {
      padding: 15px 20px;
    }
    h4 {
      font-size: 1.75rem;
    }
    table {
      font-size: 0.9rem;
    }
    .btn-danger, .btn-success {
      width: 100%;
      padding: 10px 0;
      font-size: 1rem;
    }
    .text-end h5 {
      text-align: center;
    }
  }
</style>

<h4>Keranjang</h4>

@if($keranjang->isEmpty())
  <div class="alert alert-info">Keranjang kosong.</div>
@else
  <div class="card">
    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th>Kereta</th>
            <th>Rute</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Kelas</th>
            <th>Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php $total = 0; @endphp
          @foreach($keranjang as $item)
            @php 
              $harga = $item->jadwal->harga ?? $item->jadwal->harga_tiket ?? 0;
              $subtotal = $harga * $item->jumlah; 
              $total += $subtotal; 
            @endphp
          <tr>
            <td>{{ $item->jadwal->nama_kereta }}</td>
            <td>{{ $item->jadwal->stasiun_asal }} → {{ $item->jadwal->stasiun_tujuan }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>Rp {{ number_format($harga) }}</td>
            <td>{{ $item->jadwal->kelas }}</td>
            <td>Rp {{ number_format($subtotal) }}</td>
            <td>
              <form action="{{ route('pelanggan.keranjang.hapus', $item->id ?? 0) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="text-end mt-4">
      <h5>Total: Rp {{ number_format($total) }}</h5>

      <form action="{{ route('pelanggan.checkout') }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-success" type="submit">Checkout</button>
      </form>
    </div>
  </div>
@endif
@endsection
