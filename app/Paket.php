<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'tb_paket';
    protected $primaryKey = 'id_paket';
    protected $fillable = [
        'nama_paket', 'harga_paket','id_wo','gambar_paket',
    ];

   
   
}
