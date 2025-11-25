<?php

namespace App\Http\Controllers;

use App\Models\JadwalKereta;
use Illuminate\Http\Request;

class JadwalKeretaController extends Controller
{
    public function index()
    {
        $jadwal = JadwalKereta::orderBy('tanggal', 'asc')->get();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kereta' => 'required|string|max:255',
            'asal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'tanggal_keberangkatan' => 'required|date',
            'jam_keberangkatan' => 'required',
            'harga' => 'required|numeric',
            'status' => 'required|in:tersedia,habis',
        ]);

        JadwalKereta::create([
            'nama_kereta' => $request->nama_kereta,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'jam_keberangkatan' => $request->jam_keberangkatan,
            'harga' => $request->harga,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.jadwal')->with('success', 'Jadwal kereta berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jadwal = JadwalKereta::findOrFail($id);
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kereta'    => 'required',
            'stasiun_asal'   => 'required',
            'stasiun_tujuan' => 'required',
            'tanggal'        => 'required|date',
            'jam_berangkat'  => 'required',
            'kelas'          => 'required',
            'harga'          => 'required|numeric',
            'kursi'          => 'required|integer',
        ]);

        $jadwal = JadwalKereta::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal kereta berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalKereta::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal kereta berhasil dihapus.');
    }
}
