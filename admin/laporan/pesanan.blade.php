@extends('layouts.admin')

@section('content')
<h2>Laporan Pesanan</h2>

<a href="{{ route('admin.laporan.pesanan.cetak') }}" class="btn btn-danger mb-3" target="_blank">
    Cetak PDF
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Kode Tiket</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $o)
        <tr>
            <td>{{ $o->id }}</td>
            <td>{{ $o->user->name }}</td>
            <td>{{ $o->kode_tiket }}</td>
            <td>Rp {{ number_format($o->total_harga,0,',','.') }}</td>
            <td>{{ $o->status }}</td>
            <td>{{ $os->payment_method }}</td> 
            <td>{{ $o->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
