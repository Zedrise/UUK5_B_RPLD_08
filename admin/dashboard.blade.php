@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.9);
        --glass-border: rgba(255, 255, 255, 0.3);
        --shadow-light: 0 8px 20px rgba(0, 0, 0, 0.1);
        --shadow-hover: 0 12px 30px rgba(0, 0, 0, 0.2);
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --accent-color: #008148;
        --text-muted: #6c757d;
    }

    .dashboard-header {
        
        color: #ffaa00;
        padding: 30px;
        border-radius: 20px;
        margin-bottom: 30px;
        box-shadow: var(--shadow-light);
        animation: slideInDown 0.8s ease;
    }

    .dashboard-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .alert-custom {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        color: white;
        border: none;
        border-radius: 15px;
        padding: 20px;
        box-shadow: var(--shadow-light);
        animation: bounceIn 0.6s ease;
    }

    .glass-card {
        backdrop-filter: blur(15px);
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow-light);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        text-align: center;
        height: 100%;
    }

    .glass-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.6s ease;
    }

    .glass-card:hover::before {
        left: 100%;
    }

    .glass-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-hover);
        background: rgba(255, 255, 255, 0.95);
    }

    .card-icon {
        font-size: 50px;
        opacity: 0.8;
        transition: all 0.3s ease;
        margin-bottom: 15px;
    }

    .glass-card:hover .card-icon {
        opacity: 1;
        transform: scale(1.1) rotate(5deg);
    }

    .glass-card h5 {
        font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 10px;
    }

    .glass-card h2 {
        font-weight: 800;
        font-size: 2rem;
        color: #333;
        margin: 0;
    }

    .chart-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--shadow-light);
        transition: all 0.3s ease;
        border: 1px solid var(--glass-border);
        backdrop-filter: blur(10px);
    }

    .chart-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .chart-card h5 {
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chart-card h5 i {
        font-size: 24px;
        color: var(--accent-color);
    }

    canvas {
        max-height: 300px;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 20px;
        }
        .dashboard-header h2 {
            font-size: 2rem;
        }
        .glass-card {
            padding: 20px;
        }
        .chart-card {
            padding: 20px;
        }
    }

    @keyframes slideInDown {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    @keyframes bounceIn {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); }
        70% { transform: scale(0.9); }
        100% { transform: scale(1); opacity: 1; }
    }
</style>

<div class="dashboard-header">
    <h2>👑 Dashboard Admin</h2>
</div>

@if($pesananBaru > 0)
<div class="alert alert-custom shadow-sm">
    <i class='bx bx-bell'></i> <strong>{{ $pesananBaru }}</strong> Pesanan Baru Menunggu Diproses!
</div>
@endif

<div class="row g-4">
    <div class="col-md-3 col-sm-6">
        <div class="glass-card">
            <i class='bx bxs-user card-icon' style="color: #667eea;"></i>
            <h5>Total Pengguna</h5>
            <h2>{{ $totalUser }}</h2>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="glass-card">
            <i class='bx bxs-train card-icon' style="color: #764ba2;"></i>
            <h5>Jadwal Kereta</h5>
            <h2>{{ $totalJadwal }}</h2>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="glass-card">
            <i class='bx bxs-cart card-icon' style="color: #f093fb;"></i>
            <h5>Total Pesanan</h5>
            <h2>{{ $totalPesanan }}</h2>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="glass-card">
            <i class='bx bxs-wallet card-icon' style="color: #f5576c;"></i>
            <h5>Total Pendapatan</h5>
            <h2>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
        </div>
    </div>
</div>

<div class="row mt-5 g-4">
    <div class="col-md-6">
        <div class="chart-card">
            <h5><i class='bx bx-bar-chart-alt-2'></i> Grafik Pesanan</h5>
            <canvas id="chartPesanan"></canvas>
        </div>
    </div>

    <div class="col-md-6">
        <div class="chart-card">
            <h5><i class='bx bx-line-chart'></i> Grafik Pendapatan</h5>
            <canvas id="chartPendapatan"></canvas>
        </div>
    </div>
</div>

<input type="hidden" id="dataPesanan" value='@json($chartPesanan)'>
<input type="hidden" id="dataPendapatan" value='@json($chartPendapatan)'>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/chart-admin.js') }}"></script>

@endsection