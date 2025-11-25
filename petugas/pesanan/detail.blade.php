@extends('layouts.petugas')

@section('title','Detail Pesanan')

@section('content')
<style>
  h3 {
    font-weight: 700;
    font-size: 2.4rem;
    margin-bottom: 30px;
    color: #1e3932;
    text-shadow: 0 1px 3px rgba(0,0,0,0.15);
  }

  p {
    font-size: 1.1rem;
    margin-bottom: 15px;
    color: #34495e;
  }

  p strong {
    color: #008148;
    font-weight: 700;
  }

  h4 {
    font-weight: 700;
    font-size: 1.8rem;
    margin-top: 40px;
    margin-bottom: 20px;
    color: #1e3932;
  }

  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 12px;
    font-size: 1rem;
    margin-bottom: 25px;
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
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(30, 57, 50, 0.1);
    transition: background 0.3s ease;
  }
  tbody tr:hover {
    background: #d9eadf;
  }

  tbody td {
    padding: 14px 12px;
    text-align: center;
    color: #3a5a40;
    border: none;
    vertical-align: middle;
  }

  tbody td:first-child {
    font-weight: 600;
  }

  form {
    max-width: 300px;
    margin-top: 10px;
  }

  label {
    font-weight: 600;
    font-size: 1rem;
    color: #1e3932;
    margin-bottom: 6px;
    display: inline-block;
  }

  select.form-control.w-25 {
    width: 150px !important;
    padding: 8px 12px;
    font-size: 1rem;
    border-radius: 10px;
    border: 1.8px solid #ccc;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  select.form-control.w-25:focus {
    border-color: #008148;
    outline: none;
    box-shadow: 0 0 8px rgba(0, 129, 72, 0.3);
  }

  button.btn.btn-success.mt-2 {
    background: linear-gradient(135deg, #008148 0%, #00a65a 100%);
    border: none;
    padding: 10px 30px;
    border-radius: 15px;
    font-weight: 700;
    font-size: 1rem;
    color: white;
    cursor: pointer;
    box-shadow: 0 8px 25px rgba(0, 129, 72, 0.3);
    transition: background 0.3s ease, box-shadow 0.3s ease;
  }

  button.btn.btn-success.mt-2:hover {
    background: linear-gradient(135deg, #005a36 0%, #007536 100%);
    box-shadow: 0 12px 35px rgba(0, 117, 54, 0.6);
  }

  @media (max-width: 768px) {
    h3 {
      font-size: 2rem;
    }
    h4 {
      font-size: 1.5rem;
    }
    select.form-control.w-25 {
      width: 100% !important;
    }
    form {
      max-width: 100%;
    }
  }
</style>

<h3>Detail Pesanan — {{ $order->kode_tiket }}</h3>

<p><strong>Pelanggan:</strong> {{ $order->user->name }}</p>
<p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
<p><strong>Total Harga:</strong> Rp {{ number_format($order->total_harga) }}</p>

<h4>Detail Item</h4>
<table>
  <thead>
    <tr>
        <th>Nama Kereta</th>
        <th>Stasiun</th>
        <th>Jumlah</th>
        <th>Kelas</th>
        <th>Harga</th>
        <th>Subtotal</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($order->items as $i)
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

<form action="{{ route('petugas.pesanan.status', $order->id) }}" method="POST">
  @csrf
  <label for="status">Status:</label>
  <select name="status" id="status" class="form-control w-25" aria-label="Pilih status pesanan">
      <option value="diproses" @if($order->status == 'diproses') selected @endif>Diproses</option>
      <option value="selesai" @if($order->status == 'selesai') selected @endif>Selesai</option>
  </select>

  <button type="submit" class="btn btn-success mt-2">Update Status</button>
</form>
@endsection