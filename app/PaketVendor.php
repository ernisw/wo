<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketVendor extends Model
{
    protected $table = 'tb_paket';
    protected $primaryKey = 'id_paket';
    protected $fillable = [
        'nama_paket', 'list_paket', 'harga_paket', 'id_vendor', 'gambar_paket', 
    ];
}
