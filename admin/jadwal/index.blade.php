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

  .btn-success {
    background: linear-gradient(135deg, #008148 0%, #00a65a 100%);
    border: none;
    padding: 10px 25px;
    font-weight: 700;
    font-size: 1rem;
    color: white;
    border-radius: 15px;
    box-shadow: 0 6px 25px rgba(0, 129, 72, 0.3);
    transition: background 0.3s ease, box-shadow 0.3s ease;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 20px;
  }

  .btn-success:hover {
    background: linear-gradient(135deg, #005a36 0%, #007536 100%);
    box-shadow: 0 10px 35px rgba(0, 117, 54, 0.5);
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

  .btn-warning {
    background: #ffc107;
    border: none;
    color: #212529;
    border-radius: 12px;
    padding: 6px 20px;
    font-weight: 600;
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
    transition: background 0.3s ease;
  }

  .btn-warning:hover {
    background: #e0a800;
    box-shadow: 0 8px 20px rgba(224, 168, 0, 0.5);
    color: #212529;
  }

  .btn-danger {
    background: #dc3545;
    border: none;
    color: white;
    border-radius: 12px;
    padding: 6px 20px;
    font-weight: 600;
    box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    transition: background 0.3s ease;
  }

  .btn-danger:hover {
    background: #b02a37;
    box-shadow: 0 8px 20px rgba(176, 42, 55, 0.5);
  }

  form.d-inline {
    display: inline-block;
  }

  .alert {
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 128, 37, 0.25);
    padding: 15px;
    margin-bottom: 25px;
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
    .btn-warning, .btn-danger {
      margin-top: 5px;
      width: 100px;
      padding: 6px 10px;
    }
    .btn-success {
      width: 100%;
      padding: 12px 0;
      font-size: 1.05rem;
    }
  }
</style>

<div class="container-fluid">
    <h2>Daftar Jadwal Kereta</h2>

    <a href="{{ route('admin.jadwal.create') }}" class="btn btn-success">
        + Tambah Jadwal
    </a>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kereta</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Tanggal</th>
                <th>Jam Berangkat</th>
                <th>Kelas</th>
                <th>Harga</th>
                <th>Kursi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jadwal as $index => $j)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $j->nama_kereta }}</td>
                <td>{{ $j->stasiun_asal }}</td>
                <td>{{ $j->stasiun_tujuan }}</td>
                <td>{{ $j->tanggal }}</td>
                <td>{{ $j->jam_berangkat }}</td>
                <td>{{ $j->kelas }}</td>
                <td>Rp {{ number_format($j->harga, 0, ',', '.') }}</td>
                <td>{{ $j->kursi }}</td>
                <td>
                    {{-- TOMBOL EDIT --}}
                    <a href="{{ route('admin.jadwal.edit', $j->id) }}" 
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    {{-- TOMBOL DELETE --}}
                    <form action="{{ route('admin.jadwal.delete', $j->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">Belum ada jadwal kereta.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection