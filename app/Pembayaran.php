<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'tb_pembayaran';
    protected $primaryKey = 'id_bayar';
    protected $fillable = [
        'id_item', 'id_user','jenis','status_bayar', 'tanggal_nikah', 'bukti_pembayaran',
    ];
}
