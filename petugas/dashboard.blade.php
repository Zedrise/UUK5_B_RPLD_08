@extends('layouts.petugas')

@section('title', 'Dashboard')

@section('content')
<h2>Dashboard Petugas</h2>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5>Total Pesanan</h5>
                <h3>{{ $totalPesanan }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5>Pesanan Aktif</h5>
                <h3>{{ $pesananAktif }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Pesanan Selesai</h5>
                <h3>{{ $pesananSelesai }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection
