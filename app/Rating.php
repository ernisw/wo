<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'tb_rating';
    protected $primaryKey = 'id_rating';
    protected $fillable = [
        'id_user', 'id_vendor_wo', 'nilai', 
    ];
}
