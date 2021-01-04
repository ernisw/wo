<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'tb_pengguna';
    protected $fillable = [
        'username', 'password', 'nama_lengkap', 'email', 'no_telp', 'gambar_pengguna', 'role',
    ];
    protected $hidden = [
        'password',
    ];

//     public function pengguna()
//     {
//         return $this->belongsTo('App\Pengguna');
//     }
}
