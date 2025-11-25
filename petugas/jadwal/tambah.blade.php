@extends('layouts.petugas')

@section('title', 'Tambah Jadwal')

@section('content')
<style>
  h3 {
    font-weight: 700;
    font-size: 2.4rem;
    margin-bottom: 30px;
    color: #1e3932;
    text-shadow: 0 1px 3px rgba(0, 57, 50, 0.2);
  }

  form {
    max-width: 500px;
    background: #fff;
    padding: 30px 35px;
    border-radius: 20px;
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.12);
  }

  .mb-3 label {
    font-weight: 600;
    display: block;
    margin-bottom: 8px;
    color: #1e3932;
    font-size: 1.1rem;
  }

  .form-control {
    border-radius: 12px;
    padding: 12px 15px;
    font-size: 1rem;
    border: 1.8px solid #ccc;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  .form-control:focus {
    border-color: #008148;
    box-shadow: 0 0 10px rgba(0, 129, 72, 0.3);
    outline: none;
  }

  .btn-primary {
    margin-top: 15px;
    background: linear-gradient(135deg, #008148 0%, #00a65a 100%);
    border: none;
    padding: 15px 40px;
    border-radius: 15px;
    font-weight: 700;
    font-size: 1.1rem;
    color: #fff;
    cursor: pointer;
    box-shadow: 0 8px 30px rgba(0, 129, 72, 0.3);
    transition: background 0.3s ease, box-shadow 0.3s ease;
  }

  .btn-primary:hover {
    background: linear-gradient(135deg, #005a36 0%, #007536 100%);
    box-shadow: 0 12px 40px rgba(0, 117, 54, 0.5);
  }

  @media (max-width: 576px) {
    form {
      padding: 20px;
      max-width: 100%;
    }

    .btn-primary {
      width: 100%;
      padding: 15px 0;
      font-size: 1.2rem;
    }
  }
</style>

<h3>Tambah Jadwal Kereta</h3>

<form action="{{ route('petugas.jadwal.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Kereta</label>
        <input type="text" name="nama_kereta" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Stasiun Asal</label>
        <input type="text" name="stasiun_asal" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Stasiun Tujuan</label>
        <input type="text" name="stasiun_tujuan" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Jam Berangkat</label>
        <input type="time" name="jam_berangkat" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" min="0" required>
    </div>

    <button class="btn btn-primary" type="submit">Simpan</button>
</form>
@endsection