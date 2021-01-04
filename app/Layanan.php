<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'tb_layanan';
    protected $primaryKey = 'id_layanan';
    protected $fillable = [
        'id_layanan', 'nama_layanan', 'jenis_layanan', 'harga', 'id_vendor','gambar_layanan',
    ];

    // public function paket()
    // {
    //     return $this->belongsTo('App\Paket');
    // }
}
