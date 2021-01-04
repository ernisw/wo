<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Layanan;
use App\Paket;


class CartController extends Controller
{
    // public function index()
    // {
    //     $data = Cart::all();
    //     if($data){
    //         return responData('Data didaptkan!', $data, true);
    //     }else{
    //         return responData('Data tidak ada', '', false);
    //     }
    // }

    // public function getAllCart () {
    //     $data = Cart::all();
    //     return json_encode([
    //         'sukses' => true,
    //         'data' => $data
    //     ]);
    // }

    public function store(Request $request)
    {

        $insert = Cart::create($request->all());

        if($insert){
            return responData('Berhasil menambah data!', '', true);
        }else {
            return responData('Gagal menambah data!', '', false);
        }

    }

    public function get ($id){
        $data = Cart::where('id_user', $id)->get()->toArray();
        $newData = array();
        for ($i=0; $i < sizeof($data); $i++) { 
            $id = $data[$i]['id_item'];
            $detail=null;
            if ($data[$i]['jenis'] === 'paket') {
                $detail = Paket::where('id_paket', $id)
                        ->join('users', 'users.id', '=', 'tb_paket.id_wo')
                        ->first();
            } else {
                $detail = Layanan::where('id_layanan', $id)
                    ->join('users', 'users.id', '=', 'tb_layanan.id_vendor')
                    ->first();
            }
            $data[$i]['detail'] = $detail;
            array_push($newData, $data[$i]);
        }
        return json_encode([
            'data'=> $newData
        ]);
    }

    public function destroy ($id){
        $delete = Cart::where('id_cart', $id)->delete();
        $alert = [];
        if ($delete) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Delete';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Delete';
        }
        return json_encode($alert);
    }
}
