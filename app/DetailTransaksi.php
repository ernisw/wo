<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'tb_detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    protected $fillable = [
        'id_detail_transaksi', 'id_transaksi', 'id_layanan',
    ];
}
