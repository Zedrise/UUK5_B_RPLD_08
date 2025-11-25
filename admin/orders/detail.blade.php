@extends('layouts.admin')

@section('content')
<style>
  h3 {
    font-weight: 700;
    font-size: 2.4rem;
    color: #1e3932;
    margin-bottom: 25px;
    text-shadow: 0 1px 3px rgba(0, 57, 50, 0.2);
  }

  h4 {
    font-weight: 600;
    font-size: 1.8rem;
    color: #2d5a47;
    margin-top: 30px;
    margin-bottom: 15px;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }

  .detail-box {
    background: #f1f6f4;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 3px 10px rgba(30, 57, 50, 0.1);
    margin-bottom: 25px;
  }

  .detail-box p {
    font-size: 1.1rem;
    color: #2f4f4f;
    margin-bottom: 10px;
  }

  .badge {
    font-size: 0.9rem;
    padding: 8px 15px;
    border-radius: 20px;
  }

  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
    font-size: 1rem;
  }

  thead tr th {
    background: linear-gradient(135deg, #1e3932 0%, #2d5a47 100%);
    color: white;
    border: none;
    font-weight: 700;
    padding: 12px 15px;
    text-align: center;
    border-radius: 12px 12px 0 0;
  }

  tbody tr {
    background: #f1f6f4;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(30, 57, 50, 0.1);
    transition: background 0.3s ease;
  }

  tbody tr:hover {
    background: #d9eadf;
  }

  tbody td {
    padding: 12px 15px;
    text-align: center;
    vertical-align: middle;
    color: #2f4f4f;
    border: none;
  }

  tbody td:first-child {
    font-weight: 600;
  }

  .btn-success {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    border: none;
    padding: 10px 25px;
    font-weight: 600;
    font-size: 1rem;
    color: white;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    transition: background 0.3s ease, box-shadow 0.3s ease;
    text-decoration: none;
    display: inline-block;
  }

  .btn-success:hover {
    background: linear-gradient(135deg, #1e7e34 0%, #155724 100%);
    box-shadow: 0 8px 20px rgba(30, 126, 52, 0.5);
  }

  hr {
    border: none;
    height: 2px;
    background: linear-gradient(90deg, #1e3932, #2d5a47);
    margin: 30px 0;
  }

  @media (max-width: 768px) {
    .container {
      padding: 15px;
    }
    table {
      font-size: 0.9rem;
    }
    thead tr th, tbody td {
      padding: 8px 10px;
    }
    tbody td {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 5px;
    }
    .btn-success {
      width: 100%;
      padding: 12px 0;
      font-size: 1.05rem;
    }
    .detail-box {
      padding: 15px;
    }
  }
</style>

<div class="container">
    <h3>📋 Detail Pesanan — {{ $order->kode_tiket }}</h3>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success" role="alert" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0, 128, 37, 0.25); padding: 15px; margin-bottom: 25px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger" role="alert" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(176, 42, 55, 0.25); padding: 15px; margin-bottom: 25px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="detail-box">
        <p><strong>👤 Pelanggan:</strong> {{ $order->user->name }}</p>
        <p><strong>📊 Status:</strong> 
            <span class="badge bg-primary">{{ $order->status }}</span>
        </p>
        <p><strong>💰 Total Harga:</strong> <span class="text-success fw-bold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span></p>
    </div>

    <hr>

    <h4>Item Pesanan</h4>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Kereta</th>
                    <th>Stasiun</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($order->items as $item)
                    <tr>
                        <td>{{ $item->jadwal->nama_kereta }}</td>
                        <td>{{ $item->jadwal->stasiun_asal }} → {{ $item->jadwal->stasiun_tujuan }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="fw-bold text-success">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="fas fa-info-circle fa-2x mb-2"></i>
                        <br>
                        Tidak ada item pesanan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <hr>

    {{-- TOMBOL CETAK LAPORAN --}}
    <a href="{{ route('admin.orders.cetak', $order->id) }}" 
       class="btn btn-success" target="_blank">
        🖨 Cetak Laporan Pesanan Ini
    </a>
</div>
@endsection