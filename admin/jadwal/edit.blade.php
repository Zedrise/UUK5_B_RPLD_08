@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Edit Jadwal Kereta</h2>

    <form action="{{ route('admin.jadwal.update', $jadwal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Kereta</label>
            <input type="text" name="nama_kereta" value="{{ $jadwal->nama_kereta }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stasiun Asal</label>
            <input type="text" name="stasiun_asal" value="{{ $jadwal->stasiun_asal }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stasiun Tujuan</label>
            <input type="text" name="stasiun_tujuan" value="{{ $jadwal->stasiun_tujuan }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ $jadwal->tanggal }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jam Berangkat</label>
            <input type="time" name="jam_berangkat" value="{{ $jadwal->jam_berangkat }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kelas</label>
            <select name="kelas" class="form-control">
                <option value="ekonomi" {{ $jadwal->kelas=='ekonomi' ? 'selected':'' }}>Ekonomi</option>
                <option value="bisnis" {{ $jadwal->kelas=='bisnis' ? 'selected':'' }}>Bisnis</option>
                <option value="eksekutif" {{ $jadwal->kelas=='eksekutif' ? 'selected':'' }}>Eksekutif</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $jadwal->harga }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kursi Tersedia</label>
            <input type="number" name="kursi" value="{{ $jadwal->kursi }}" class="form-control" required>
        </div>

        <button class="btn btn-primary">Perbarui</button>
        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
