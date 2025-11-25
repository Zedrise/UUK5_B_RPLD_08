@extends('layouts.petugas')

@section('title', 'Kelola Pesanan')

@section('content')
<style>
  h3 {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 30px;
    color: #2c3e50;
    text-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }

  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
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
    background: #f6f8fa;
    border-radius: 12px;
    box-shadow: 0 3px 8px rgba(30, 57, 50, 0.1);
    transition: background 0.3s ease;
  }

  tbody tr:hover {
    background: #d9e9de;
  }

  tbody td {
    padding: 15px 10px;
    vertical-align: middle;
    text-align: center;
    color: #2f4f4f;
    border: none;
  }

  form select.form-select-sm {
    max-width: 130px;
    border-radius: 8px;
    border: 1.8px solid #ccc;
    padding: 4px 10px;
    font-size: 0.9rem;
    transition: border-color 0.3s ease;
  }

  form select.form-select-sm:focus {
    border-color: #008148;
    outline: none;
    box-shadow: 0 0 8px rgba(0, 129, 72, 0.3);
  }

  .btn-success {
    border-radius: 12px;
    padding: 6px 18px;
    font-weight: 600;
    background: linear-gradient(135deg, #008148 0%, #00a65a 100%);
    border: none;
    box-shadow: 0 5px 15px rgba(0, 129, 72, 0.3);
    color: white;
    cursor: pointer;
    transition: background 0.3s ease, box-shadow 0.3s ease;
  }

  .btn-success:hover {
    background: linear-gradient(135deg, #005a36 0%, #007536 100%);
    box-shadow: 0 8px 25px rgba(0, 117, 54, 0.6);
  }
  
  @media (max-width: 768px) {
    table {
      font-size: 0.9rem;
    }
    thead tr th, tbody td {
      padding: 10px 8px;
    }
    form select.form-select-sm {
      max-width: 100%;
      width: 100%;
      margin-bottom: 10px;
    }
    .btn-success {
      width: 100%;
      padding: 10px 0;
      font-size: 1rem;
    }
    tbody td {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }
    tbody td:last-child {
      flex-direction: row;
      justify-content: center;
      gap: 10px;
    }
  }
</style>

<h3>Kelola Pesanan</h3>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Pelanggan</th>
      <th>Total</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($orders as $o)
    <tr>
      <td>{{ $o->id }}</td>
      <td>{{ $o->user->name }}</td>
      <td>Rp {{ number_format($o->total_harga) }}</td>
      <td>{{ ucfirst($o->status) }}</td>
      <td>
        <form action="{{ route('petugas.pesanan.status', $o->id) }}" method="POST" class="d-flex flex-column flex-sm-row align-items-center gap-2">
          @csrf
          <select name="status" class="form-select form-select-sm">
              <option value="diproses" @if($o->status=='diproses') selected @endif>Diproses</option>
              <option value="selesai" @if($o->status=='selesai') selected @endif>Selesai</option>
              <option value="dibatalkan" @if($o->status=='dibatalkan') selected @endif>Dibatalkan</option>
          </select>
          <button class="btn btn-success btn-sm" type="submit">Update</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection