<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'tb_cart';
    protected $primaryKey = 'id_cart';
    protected $fillable = [
        'id_cart', 'id_item', 'id_user', 'jenis', 
    ];
}
