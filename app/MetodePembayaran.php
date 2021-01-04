<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    protected $table = 'tb_metode_pembayaran';
    protected $primaryKey = 'id_metode_pembayaran';
    protected $fillable = [
        'id_metode_pembayaran', 'nama_bank'
    ];
}
