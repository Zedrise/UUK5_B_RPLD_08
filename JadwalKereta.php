<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKereta extends Model
{
    protected $table = 'jadwal_kereta';

    protected $fillable = [
        'nama_kereta',
        'stasiun_asal',
        'stasiun_tujuan',
        'tanggal',
        'jam_berangkat',
        'kelas', 
        'harga',
        'kursi'
    ];
}
