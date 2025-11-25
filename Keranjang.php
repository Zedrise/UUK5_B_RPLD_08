<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';

    protected $fillable = [
        'user_id',
        'jadwal_id',
        'jumlah',
        'subtotal',
        'catatan'
    ];

    public function jadwal()
{
    return $this->belongsTo(\App\Models\JadwalKereta::class, 'jadwal_id');
}

}
