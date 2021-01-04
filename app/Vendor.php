<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'tb_vendor';
    protected $primaryKey = 'id_vendor';
    protected $fillable = [
       'nama_vendor', 'alamat', 'no_hp', 'gambar_vendor',
    ];
   
}
