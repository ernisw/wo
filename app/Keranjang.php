<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'tb_keranjang';
    protected $primaryKey = 'id_keranjang';
    protected $fillable = [
        'id_keranjang', 'id_pengguna', 'id_barang', 'jenis'
    ];
}
