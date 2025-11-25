@extends('layouts.admin')

@section('content')
<style>
  h2 {
    font-weight: 700;
    font-size: 2.4rem;
    color: #1e3932;
    margin-bottom: 25px;
    text-shadow: 0 1px 3px rgba(0, 57, 50, 0.2);
  }

  .btn-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
    padding: 8px 20px;
    font-weight: 600;
    font-size: 0.9rem;
    color: white;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    transition: background 0.3s ease, box-shadow 0.3s ease;
    text-decoration: none;
    display: inline-block;
  }

  .btn-primary:hover {
    background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
    box-shadow: 0 8px 20px rgba(0, 86, 179, 0.5);
  }

  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 12px;
    font-size: 1rem;
  }

  thead tr th {
    background: linear-gradient(135deg, #1e3932 0%, #2d5a47 100%);
    color: white;
    border: none;
    font-weight: 700;
    padding: 14px 15px;
    text-align: center;
    border-radius: 12px 12px 0 0;
  }

  tbody tr {
    background: #f1f6f4;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(30, 57, 50, 0.1);
    transition: background 0.3s ease;
  }

  tbody tr:hover {
    background: #d9eadf;
  }

  tbody td {
    padding: 15px 12px;
    text-align: center;
    vertical-align: middle;
    color: #2f4f4f;
    border: none;
  }

  tbody td:first-child {
    font-weight: 600;
  }

  .badge {
    font-size: 0.85rem;
    padding: 6px 12px;
    border-radius: 20px;
  }

  @media (max-width: 768px) {
    table {
      font-size: 0.9rem;
    }
    thead tr th, tbody td {
      padding: 10px 8px;
    }
    tbody td {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
    }
    tbody td:last-child {
      flex-direction: row;
    }
    .btn-primary {
      margin-top: 5px;
      width: 100px;
      padding: 6px 10px;
    }
  }
</style>

<div class="container-fluid">
    <h2>📦 Daftar Pesanan</h2>

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

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-success">
                <tr>
                    <th>Kode Tiket</th>
                    <th>Pelanggan</th>
                    <th>Total Harga</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->kode_tiket }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td class="fw-bold text-success">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>
                            <span class="badge bg-info">{{ $order->status }}</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.detail', $order->id) }}" class="btn btn-primary btn-sm">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="fas fa-info-circle fa-2x mb-2"></i>
                        <br>
                        Belum ada pesanan yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection