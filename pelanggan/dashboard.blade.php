@extends('layouts.app')

@section('title','Dashboard Pelanggan')

@section('content')
<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.9);
        --glass-border: rgba(255, 255, 255, 0.3);
        --shadow-light: 0 8px 20px rgba(0, 0, 0, 0.1);
        --shadow-hover: 0 12px 30px rgba(0, 0, 0, 0.2);
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --accent-color: #008148;
        --text-muted: #6c757d;
    }

    .dashboard-container {
        max-width: 100%; /* Bootstrap container max-width for large screens */
        margin: 0 auto;
        padding: 20px 15px; /* beri padding sisi agar muat layar */
    }

    .dashboard-header {
        background: var(--primary-gradient);
        color: white;
        padding: 20px 25px;
        border-radius: 15px;
        margin-bottom: 20px;
        box-shadow: var(--shadow-light);
        animation: slideInDown 0.8s ease;
    }

    .dashboard-header h3 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .dashboard-header p {
        font-size: 1rem;
        margin: 8px 0 0 0;
        opacity: 0.9;
    }

    .glass-card {
        backdrop-filter: blur(15px);
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        position: relative;
        overflow: hidden;
        text-align: center;
        height: 100%;
    }

    .glass-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            90deg,
            transparent,
            rgba(255, 255, 255, 0.5),
            transparent
        );
        transition: left 0.6s ease;
    }

    .glass-card:hover::before {
        left: 100%;
    }

    .glass-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
    }

    .glass-card h6 {
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 10px;
        font-size: 1rem;
    }

    .glass-card h2 {
        font-weight: 800;
        font-size: 2.4rem;
        color: #333;
        margin: 0;
    }


    .action-buttons {
        margin-top: 30px;
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap; 
        padding: 0 10px; 
    }

    .btn-custom {
        background: linear-gradient(135deg, var(--accent-color) 0%, #00a65a 100%);
        color: #fff;
        border: none;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap; 
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 129, 72, 0.4);
    }

    .btn-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .btn-custom:hover::before {
        left: 100%;
    }

    .btn-outline-custom {
        background: transparent;
        color: var(--accent-color);
        border: 2px solid var(--accent-color);
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .btn-outline-custom:hover {
        background: var(--accent-color);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 129, 72, 0.4);
    }

    /* Responsive adjustments */
    @media (max-width: 991.98px) {
        .dashboard-container {
            max-width: 90vw;
        }
        .glass-card h2 {
            font-size: 1.8rem;
        }
        .dashboard-header h3 {
            font-size: 1.7rem;
        }
    }

    @media (max-width: 576px) {
        .glass-card h2 {
            font-size: 1.5rem;
        }
        .dashboard-header h3 {
            font-size: 1.5rem;
        }
        .action-buttons {
            flex-direction: column;
            gap: 12px;
        }
        .btn-custom,
        .btn-outline-custom {
            width: 100%;
            justify-content: center;
        }
    }

    @keyframes slideInDown {
        from { transform: translateY(-30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h3>Halo, {{ Auth::user()->name ?? 'Pelanggan' }}</h3>
        <p>Selamat datang di panel pengguna.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4 col-sm-6 col-12">
            <div class="glass-card">
                <h6>Total Pesanan</h6>
                <h2>{{ \App\Models\Order::where('user_id', Auth::id())->count() }}</h2>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <div class="glass-card">
                <h6>Pesanan Aktif</h6>
                <h2>{{ \App\Models\Order::where('user_id', Auth::id())->where('status','diproses')->count() }}</h2>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <div class="glass-card">
                <h6>Pesanan Selesai</h6>
                <h2>{{ \App\Models\Order::where('user_id', Auth::id())->where('status','selesai')->count() }}</h2>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ route('pelanggan.jadwal') }}" class="btn-custom">
            <i class='bx bxs-train'></i> Cari Jadwal & Pesan
        </a>
        <a href="{{ route('pelanggan.keranjang') }}" class="btn-outline-custom">
            <i class='bx bx-cart'></i> Lihat Keranjang
        </a>
    </div>
</div>
@endsection