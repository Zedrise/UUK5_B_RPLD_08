@extends('layouts.app')

@section('title','Jadwal Kereta')

@section('content')
<style>
    .card-compact {
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #fff;
        padding: 20px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-compact:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.18);
    }

    h4 {
        font-weight: 700;
        margin-bottom: 25px;
        font-size: 1.8rem;
        color: #333;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    h5 {
        font-weight: 600;
        color: #004d40;
        margin-bottom: 10px;
        font-size: 1.3rem;
    }

    p {
        margin-bottom: 8px;
        color: #555;
        font-size: 0.95rem;
    }

    p.fw-bold {
        color: #008148;
        font-size: 1.2rem;
        margin-top: 10px;
        font-weight: 700;
    }

    .btn-success {
        background: linear-gradient(135deg, #008148 0%, #00a65a 100%);
        border: none;
        font-weight: 600;
        padding: 8px 18px;
        box-shadow: 0 5px 15px rgba(0, 129, 72, 0.3);
        transition: background 0.3s ease;
    }

    .btn-success:hover {
        background: linear-gradient(135deg, #006632 0%, #008a38 100%);
    }

    .btn-primary {
        background: #1e88e5;
        border: none;
        font-weight: 600;
        padding: 8px 18px;
        box-shadow: 0 5px 15px rgba(30, 136, 229, 0.3);
        transition: background 0.3s ease;
    }

    .btn-primary:hover {
        background: #1565c0;
    }

    .d-flex.gap-2 {
        gap: 10px;
        flex-wrap: wrap;
    }

    input[type='number'] {
        max-width: 90px;
        border-radius: 8px;
        border: 1.5px solid #ccc;
        padding: 5px 10px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    input[type='number']:focus {
        border-color: #008148;
        outline: none;
        box-shadow: 0 0 6px rgba(0, 129, 72, 0.5);
    }

    @media (max-width: 768px) {
        .card-compact {
            padding: 15px;
        }

        .d-flex.gap-2 {
            flex-direction: column;
            gap: 12px;
        }

        input[type='number'] {
            width: 100%;
            max-width: unset;
        }
    }
</style>

<h4>Daftar Jadwal Kereta</h4>

<div class="row mt-3">
  @forelse($jadwal as $j)
  <div class="col-md-4 mb-4 d-flex">
    <div class="card card-compact flex-fill">
      <h5>{{ $j->nama_kereta }}</h5>
      <p class="mb-1 text-muted">{{ $j->stasiun_asal }} &rarr; {{ $j->stasiun_tujuan }}</p>
      <p class="mb-1">
        Berangkat: {{ \Carbon\Carbon::parse($j->jam_berangkat)->format('H:i') }} &mdash; 
        Tiba: {{ \Carbon\Carbon::parse($j->jam_tiba)->format('H:i') }}
      </p>
      <p class="mb-1"><strong>Kelas:</strong> {{ $j->kelas }}</p>
      <p class="fw-bold">Rp {{ number_format($j->harga ?? $j->harga_tiket ?? 0, 0, ',', '.') }}</p>

      <div class="d-flex gap-2">
        <form action="{{ route('pelanggan.keranjang.tambah') }}" method="POST" class="d-flex align-items-center">
          @csrf
          <input type="hidden" name="jadwal_id" value="{{ $j->id }}">
          <input type="number" name="jumlah" value="1" min="1" class="form-control form-control-sm me-2" style="width:80px" aria-label="Jumlah tiket">
          <button class="btn btn-success btn-sm" type="submit">Tambah</button>
        </form>

        <a href="{{ route('pelanggan.pesan', $j->id) }}" class="btn btn-primary btn-sm">Pesan Sekarang</a>
      </div>
    </div>
  </div>
  @empty
  <div class="col-12">
    <div class="alert alert-info">Belum ada jadwal tersedia.</div>
  </div>
  @endforelse
</div>
@endsection