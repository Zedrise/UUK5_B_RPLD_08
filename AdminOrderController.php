<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminOrderController extends Controller
{
    // semua pesanan
    public function index()
    {
        $orders = Order::with(['user', 'items.jadwal'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    // detail pesanan
    public function detail($id)
    {
        $order = Order::with(['user', 'items.jadwal'])
            ->findOrFail($id);

        return view('admin.orders.detail', compact('order'));
    }

    // preview
    public function laporan()
    {
        $orders = Order::with(['user', 'items.jadwal'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.laporan.pesanan', compact('orders'));
    }

    // cetak semua
    public function cetakPdf()
    {
        $orders = Order::with(['user', 'items.jadwal'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.laporan.cetak_pesanan', compact('orders'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan_pesanan.pdf');
    }

    // cetak pesanan
    public function cetakPesanan($id)
    {
        $order = Order::with(['user', 'items.jadwal'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('admin.laporan.cetak_pesanan', compact('order'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('pesanan_' . $order->kode_tiket . '.pdf');
    }

    // cetak perpesan
    public function cetakPerPesanan($id)
    {
        $order = Order::with(['user', 'items.jadwal'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('admin.laporan.cetak_per_pesanan', compact('order'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('nota_pesanan_' . $order->kode_tiket . '.pdf');
    }
}
