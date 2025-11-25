@extends('layouts.app')

@section('title','Pesan Tiket')

@section('content')
<style>
  h4 {
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 30px;
    color: #2c3e50;
    text-shadow: 0 1px 3px rgba(0,0,0,0.1);
  }
  .card {
    border-radius: 20px;
    padding: 30px 35px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    background-color: #fff;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    max-width: 500px;
    margin: 0 auto;
  }
  .card:hover {
    box-shadow: 0 14px 45px rgba(0,0,0,0.2);
    transform: translateY(-6px);
  }
  p {
    font-size: 1.05rem;
    margin-bottom: 15px;
    color: #444;
  }
  p strong {
    color: #008148;
  }

  form {
    margin-top: 25px;
  }
  label {
    font-weight: 600;
    font-size: 1rem;
    color: #333;
  }
  input[type="number"] {
    max-width: 150px;
    padding: 10px 15px;
    font-size: 1rem;
    border-radius: 12px;
    border: 1.8px solid #ccc;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }
  input[type="number"]:focus {
    border-color: #008148;
    box-shadow: 0 0 8px rgba(0,129,72,0.3);
    outline: none;
  }

  .btn-primary, .btn-outline-secondary {
    padding: 12px 30px;
    font-weight: 700;
    font-size: 1.1rem;
    border-radius: 15px;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    cursor: pointer;
  }
  .btn-primary {
    background: linear-gradient(135deg, #008148 0%, #00a65a 100%);
    border: none;
    color: #fff;
  }
  .btn-primary:hover {
    background: linear-gradient(135deg, #005a36 0%, #007536 100%);
    box-shadow: 0 12px 35px rgba(0,117,54,0.5);
  }
  .btn-outline-secondary {
    background: transparent;
    border: 2px solid #6c757d;
    color: #6c757d;
  }
  .btn-outline-secondary:hover {
    background: #6c757d;
    color: #fff;
    box-shadow: 0 12px 35px rgba(108,117,125,0.5);
  }

  .form-actions {
    display: flex;
    gap: 20px;
    margin-top: 30px;
    flex-wrap: wrap;
    justify-content: flex-start;
  }
  @media (max-width: 480px) {
    .card {
      max-width: 100%;
      padding: 20px;
    }
    .form-actions {
      flex-direction: column;
      gap: 15px;
    }
    .btn-primary, .btn-outline-secondary {
      width: 100%;
      padding: 14px 0;
      font-size: 1.2rem;
    }
    input[type="number"] {
      max-width: 100%;
    }
  }
</style>

<h4>Pesan Tiket — {{ $jadwal->nama_kereta }}</h4>

<div class="card">
  <p><strong>Rute:</strong> {{ $jadwal->stasiun_asal }} → {{ $jadwal->stasiun_tujuan }}</p>
  <p><strong>Kelas:</strong> {{ ucfirst($jadwal->kelas) }}</p>
  <p><strong>Berangkat:</strong> {{ \Carbon\Carbon::parse($jadwal->jam_berangkat)->format('d-m-Y H:i') }}</p>
  <p><strong>Harga:</strong> Rp {{ number_format($jadwal->harga ?? $jadwal->harga_tiket ?? 0) }}</p>

  <form action="{{ route('pelanggan.pesan.store', $jadwal->id) }}" method="POST" class="mt-3">
    @csrf
    <div class="mb-3" style="max-width:200px;">
      <label for="jumlah">Jumlah tiket</label>
      <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="form-control" aria-label="Jumlah tiket">
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Buat Pesanan</button>
      <a href="{{ route('pelanggan.jadwal') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
  </form>
</div>
@endsection