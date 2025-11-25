<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\JadwalKereta;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index()
    {
        // Summary box
        $totalUser       = User::count();
        $totalJadwal     = JadwalKereta::count();
        $totalPesanan    = Order::count();
        $totalPendapatan = Order::where('status', 'selesai')->sum('total_harga');

        // Notifikasi pesanan baru (status diproses)
        $pesananBaru = Order::where('status', 'diproses')->count();

        // Grafik pesanan per bulan
        $chartPesanan = Order::selectRaw('MONTH(created_at) AS bulan, COUNT(*) AS total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Grafik pendapatan per bulan
        $chartPendapatan = Order::selectRaw('MONTH(created_at) AS bulan, SUM(total_harga) AS total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalJadwal',
            'totalPesanan',
            'totalPendapatan',
            'pesananBaru',
            'chartPesanan',
            'chartPendapatan'
        ));
    }

    public function laporanPesanan()
    {
        $pesanan = Order::with(['user'])->latest()->get();
        return view('admin.laporan.pesanan', compact('pesanan'));
    }

    public function cetakLaporanPesanan()
    {
        $pesanan = Order::with(['user'])->latest()->get();

        $pdf = Pdf::loadView('admin.laporan.cetak_pesanan', compact('pesanan'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan_pesanan.pdf');
    }
}
