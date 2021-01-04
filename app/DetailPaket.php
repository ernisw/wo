<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPaket extends Model
{
    protected $table = 'tb_detail_paket';
    protected $primaryKey = 'id_detail_paket';
    protected $fillable = [
        'id_detail_paket', 'id_paket', 'id_layanan', 'statusKonfirmasi'
    ];
}
