<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_transaksi', 'id_vendor', 'id_pengguna', 'nama_paket', 'nama_vendor', 'total', 'set_tanggal_nikah', 'gambar_vendor','status',
    ];
}
