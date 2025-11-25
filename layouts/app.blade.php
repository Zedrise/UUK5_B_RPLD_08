<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Pelanggan - KAI')</title>

  <!-- Bootstrap & Boxicons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #1e3932;
      --secondary-color: #008148;
      --accent-color: #f8f9fa;
      --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      --sidebar-bg: linear-gradient(180deg, rgba(30, 57, 50, 0.95) 0%, rgba(45, 90, 71, 0.95) 100%);
      --glass-bg: rgba(255, 255, 255, 0.1);
      --glass-border: rgba(255, 255, 255, 0.2);
    }

    body {
      background: var(--bg-gradient);
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      color: #333;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 280px;
      height: 100vh;
      background: var(--sidebar-bg);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-right: 1px solid var(--glass-border);
      padding: 30px 20px;
      box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
      transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
      z-index: 1000;
      display: flex;
      flex-direction: column;
    }

    .sidebar.collapsed {
      transform: translateX(-100%);
    }

    .sidebar h4 {
      color: var(--accent-color);
      text-align: center;
      margin-bottom: 40px;
      font-weight: 700;
      font-size: 1.5rem;
      text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
      animation: fadeInUp 0.8s ease;
    }

    .nav-links {
      flex: 1;
    }

    .nav-link {
      color: var(--accent-color);
      display: flex;
      align-items: center;
      gap: 18px;
      padding: 16px 22px;
      border-radius: 15px;
      font-size: 16px;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.3s ease;
      margin-bottom: 8px;
      position: relative;
      overflow: hidden;
    }

    .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .nav-link:hover::before {
      left: 100%;
    }

    .nav-link:hover {
      background: linear-gradient(135deg, var(--secondary-color) 0%, #00a65a 100%);
      color: #fff;
      transform: translateX(8px) scale(1.02);
      box-shadow: 0 6px 20px rgba(0, 129, 72, 0.4);
    }

    .nav-link.active {
      background: linear-gradient(135deg, var(--secondary-color) 0%, #00a65a 100%);
      color: #fff;
      font-weight: 600;
      box-shadow: 0 6px 20px rgba(0, 129, 72, 0.5);
      animation: pulse 2s infinite;
    }

    .nav-link i {
      font-size: 22px;
      transition: transform 0.3s ease;
    }

    .nav-link:hover i {
      transform: rotate(10deg);
    }

    .user-info {
      margin-top: auto;
      border-top: 1px solid var(--glass-border);
      padding-top: 20px;
      color: var(--accent-color);
    }

    .user-info .text-muted {
      font-size: 12px;
      opacity: 0.7;
    }

    .logout-section {
      margin-top: 15px;
    }

    .content {
        margin-left: 280px; 
        padding: 20px 30px;
        width: calc(100% - 280px); 
        overflow-x: hidden; 
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        min-height: 100vh;
    }


    .sidebar.collapsed + .content {
      margin-left: 0;
    }

    .toggle-btn {
      display: none;
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1001;
      background: var(--primary-color);
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 55px;
      height: 55px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .toggle-btn:hover {
      background: var(--secondary-color);
      transform: scale(1.1) rotate(90deg);
    }

    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 999;
      transition: opacity 0.3s ease;
    }

    .overlay.show {
      display: block;
    }

    .alert {
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      animation: slideInDown 0.6s ease;
    }

    @media (max-width: 768px) {
      .sidebar {
        transform: translateX(-100%);
      }
      .sidebar.show {
        transform: translateX(0);
      }
      .content {
        margin-left: 0 !important;
        padding: 20px;
      }
      .toggle-btn {
        display: block;
      }
    }

    @media (min-width: 769px) {
        #overlay {
            display: none !important;
        }
    }

    
    @media (min-width: 769px) {
        sidebar {
            width: 280px;
            transform: none !important;
        }

        .sidebar.collapsed {
            width: 80px !important;
        }

        .content {
            margin-left: 280px !important;
            width: calc(100% - 280px) !important;
        }

        .content.collapsed {
            margin-left: 80px !important;
            width: calc(100% - 80px) !important;
        }

    
        #overlay {
            display: none !important;
        }
    }



    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
      0% { box-shadow: 0 6px 20px rgba(0, 129, 72, 0.5); }
      50% { box-shadow: 0 6px 30px rgba(0, 129, 72, 0.8); }
      100% { box-shadow: 0 6px 20px rgba(0, 129, 72, 0.5); }
    }

    @keyframes slideInDown {
      from { transform: translateY(-50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
  </style>

  @stack('head')
</head>
<body>

<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<button class="toggle-btn" onclick="toggleSidebar()" aria-label="Toggle Sidebar">
  <i class='bx bx-menu'></i>
</button>

<div class="sidebar" id="sidebar">
  <h4><i ></i> KAI </h4>

  <div class="nav-links">
    <a class="nav-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}"
       href="{{ route('pelanggan.dashboard') }}" aria-label="Dashboard">
      <i class='bx bx-bar-chart-alt-2'></i> Dashboard
    </a>

    <a class="nav-link {{ request()->routeIs('pelanggan.jadwal') ? 'active' : '' }}"
       href="{{ route('pelanggan.jadwal') }}" aria-label="Lihat Jadwal">
      <i class='bx bx-calendar'></i> Lihat Jadwal
    </a>

    <a class="nav-link {{ request()->routeIs('pelanggan.keranjang') ? 'active' : '' }}"
       href="{{ route('pelanggan.keranjang') }}" aria-label="Keranjang">
      <i class='bx bx-cart'></i> Keranjang
    </a>

    <a class="nav-link {{ request()->routeIs('pelanggan.pesanan') ? 'active' : '' }}"
       href="{{ route('pelanggan.pesanan') }}" aria-label="Riwayat Pesanan">
      <i class='bx bx-receipt'></i> Riwayat Pesanan
    </a>
  </div>

  <div class="user-info">
    <span class="text-muted small">Login sebagai</span>
    <div>{{ Auth::user()->name ?? 'Guest' }}</div>
    <div class="logout-section">
      <a href="{{ url('/logout') }}" class="nav-link text-danger" aria-label="Logout">
        <i class='bx bx-log-out'></i> Logout
      </a>
    </div>
  </div>
</div>

<div class="content w-100">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
<script src="{{ asset('js/Ly-pelanggan.js') }}"></script>
</body>
</html>
