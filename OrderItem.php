<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'jadwal_id',
        'kelas',
        'jumlah',
        'harga',
        'subtotal'
    ];

    public function jadwal()
{
    return $this->belongsTo(\App\Models\JadwalKereta::class, 'jadwal_id');
}

}
