<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\JadwalKereta;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function dashboard()
    {
        return view('petugas.dashboard', [
            'totalPesanan'   => Order::count(),

            'pesananAktif'   => Order::where('status', 'diproses')->count(),
            'pesananSelesai' => Order::where('status', 'selesai')->count(),
        ]);
    }
    // detail
    public function index()
    {
        $orders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('petugas.pesanan.index', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::with(['user', 'items.jadwal'])->findOrFail($id);

        return view('petugas.pesanan.detail', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,selesai',
        ]);

        $order         = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }


    //     CRUD JADWAL KERETA
    public function jadwal()
    {
        $jadwal = JadwalKereta::orderBy('id', 'desc')->get();

        return view('petugas.jadwal.index', compact('jadwal'));
    }

    public function tambahJadwal()
    {
        return view('petugas.jadwal.tambah');
    }

    public function storeJadwal(Request $r)
    {
        $r->validate([
            'nama_kereta'    => 'required',
            'stasiun_asal'   => 'required',
            'stasiun_tujuan' => 'required',
            'jam_berangkat'  => 'required',
            'jam_tiba'       => 'required',
            'harga'          => 'required|numeric',
        ]);

        JadwalKereta::create($r->all());

        return redirect()->route('petugas.jadwal')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function editJadwal($id)
    {
        $jadwal = JadwalKereta::findOrFail($id);

        return view('petugas.jadwal.edit', compact('jadwal'));
    }

    public function updateJadwal(Request $r, $id)
    {
        JadwalKereta::findOrFail($id)->update($r->all());

        return redirect()->route('petugas.jadwal')
            ->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function hapusJadwal($id)
    {
        JadwalKereta::findOrFail($id)->delete();

        return redirect()->route('petugas.jadwal')
            ->with('success', 'Jadwal berhasil dihapus!');
    }
}
