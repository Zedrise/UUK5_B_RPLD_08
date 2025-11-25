<?php

namespace App\Http\Controllers;

use App\Models\JadwalKereta;
use App\Models\Keranjang;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PelangganController extends Controller
{
    // dsh
    public function dashboard()
    {
        return view('pelanggan.dashboard');
    }

    // menampilkan semua jadwal
    public function jadwal()
    {
        $jadwal = JadwalKereta::orderBy('id', 'desc')->get();
        return view('pelanggan.jadwal.index', compact('jadwal'));
    }

    // tambah kreanjang
    public function tambahKeranjang(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required',
            'jumlah'    => 'required|integer|min:1',
        ]);

        $jadwal = JadwalKereta::findOrFail($request->jadwal_id);

        Keranjang::create([
            'user_id'   => Auth::id(),
            'jadwal_id' => $request->jadwal_id,
            'jumlah'    => $request->jumlah,
            'subtotal'  => $jadwal->harga * $request->jumlah,
        ]);

        return back()->with('success', 'Tiket ditambahkan ke keranjang!');
    }

    // halaman keranjang
    public function keranjang()
    {
        $keranjang = Keranjang::with('jadwal')
            ->where('user_id', Auth::id())
            ->get();

        return view('pelanggan.keranjang.index', compact('keranjang'));
    }
    // proses chckout
    public function checkout(Request $request)
    {
        $items = Keranjang::where('user_id', Auth::id())->get();

        if ($items->isEmpty()) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        $total = $items->sum(fn($i) => $i->jadwal->harga * $i->jumlah);

        $order = Order::create([
            'user_id'     => Auth::id(),
            'kode_tiket'  => 'TKT-' . time(),
            'total_harga' => $total,
            'status'      => 'diproses',
        ]);

        foreach ($items as $i) {
            OrderItem::create([
                'order_id' => $order->id,
                'jadwal_id' => $i->jadwal_id,
                'kelas'     => $i->jadwal->kelas,
                'jumlah'    => $i->jumlah,
                'harga'     => $i->jadwal->harga,
                'subtotal'  => $i->jadwal->harga * $i->jumlah,
            ]);
        }

        Keranjang::where('user_id', Auth::id())->delete();

        return redirect()->route('pelanggan.pesanan')
            ->with('success', 'Pesanan berhasil dilakukan!');
    }

    // daftar pesanan
    public function pesanan()
    {
        $pesanan = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pelanggan.pesanan.index', compact('pesanan'));
    }

    // detail pesanan
    public function detailPesanan($id)
    {
        $order = Order::with('items.jadwal')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pelanggan.pesanan.detail', compact('order'));
    }

    // cetak struk
    public function cetakStruk($id)
    {
        $order = Order::with('items.jadwal')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $pdf = Pdf::loadView('pelanggan.pesanan.struk', compact('order'))
            ->setPaper('a6', 'portrait');

        return $pdf->stream('struk-tiket-' . $order->kode_tiket . '.pdf');
    }

    // hapus 
    public function hapusKeranjang($id)
    {
        $item = Keranjang::findOrFail($id);
        if ($item->user_id != Auth::id()) abort(403);

        $item->delete();
        return back()->with('success', 'Item keranjang dihapus');
    }

    // halaman pesan
    public function pesan($id)
    {
        $jadwal = JadwalKereta::findOrFail($id);
        return view('pelanggan.pesan.index', compact('jadwal'));
    }
    // proses pesana
    public function store(Request $request, $id)
    {
    $jadwal = JadwalKereta::findOrFail($id);

    $request->validate([
        'jumlah' => 'required|integer|min:1',
    ]);

    $jumlah = $request->jumlah;
    $subtotal = $jadwal->harga * $jumlah;

    // Buat order baru
    $order = Order::create([
        'user_id'     => Auth::id(),
        'kode_tiket'  => 'TKT-' . time(),
        'total_harga' => $subtotal,
        'status'      => 'diproses',
    ]);

    // Buat item pesanan
    OrderItem::create([
        'order_id' => $order->id,
        'jadwal_id' => $jadwal->id,
        'kelas'     => $jadwal->kelas,
        'jumlah'    => $jumlah,
        'harga'     => $jadwal->harga,
        'subtotal'  => $subtotal,
    ]);

    return redirect()->route('pelanggan.pesanan')
        ->with('success', 'Pesanan berhasil dibuat!');
    }

}
