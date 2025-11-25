@extends('layouts.petugas')

@section('title', 'Edit Jadwal')

@section('content')
<h3>Edit Jadwal Kereta</h3>

<form action="{{ route('petugas.jadwal.update', $jadwal->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nama Kereta</label>
        <input type="text" name="nama_kereta" class="form-control" value="{{ $jadwal->nama_kereta }}" required>
    </div>

    <div class="mb-3">
        <label>Stasiun Asal</label>
        <input type="text" name="stasiun_asal" class="form-control" value="{{ $jadwal->stasiun_asal }}" required>
    </div>

    <div class="mb-3">
        <label>Stasiun Tujuan</label>
        <input type="text" name="stasiun_tujuan" class="form-control" value="{{ $jadwal->stasiun_tujuan }}" required>
    </div>

    <div class="mb-3">
        <label>Jam Berangkat</label>
        <input type="time" name="jam_berangkat" class="form-control" value="{{ $jadwal->jam_berangkat }}" required>
    </div>

   

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" value="{{ $jadwal->harga }}" required>
    </div>

    <button class="btn btn-warning">Update</button>
</form>
@endsection
