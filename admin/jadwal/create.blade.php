@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Tambah Jadwal Kereta</h2>

    <form action="{{ route('admin.jadwal.store') }}" method="POST">
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
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jam Berangkat</label>
            <input type="time" name="jam_berangkat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <select name="kelas" class="form-control">
                <option>ekonomi</option>
                <option>bisnis</option>
                <option>eksekutif</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kursi Tersedia</label>
            <input type="number" name="kursi" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

