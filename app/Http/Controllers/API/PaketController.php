<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Paket;

class PaketController extends Controller
{
    public function index()
    {
        $data = Paket::all();
        if($data){
            return responData('Data didaptkan!', $data, true);
        }else{
            return responData('Data tidak ada', '', false);
        }
    }

    public function getAllPaket () {
        $data = Paket::all();
        return json_encode([
            'sukses' => true,
            'data' => $data
        ]);
    }

public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nama_paket' => 'required|max:100',
        //     'jenis_paket' => 'required|max:100',
        //     'deskripsi' => 'required|max:100',
        //     'id_vendor' => 'image|max:2048',
        //     'gambar_paket' => 'required|max:100'
        // ]);

        $insert = Paket::create([
            'nama_paket' => $request->input('nama_paket'),
            'harga_paket' => $request->input('harga_paket'),
            'id_vendor' => $request->input('id_vendor'),
            'gambar_paket' => $request->input('gambar_paket')

        ]);

    if($insert){
        return responData('Berhasil menambah data!', '', true);
    }else {
        return responData('Gagal menambah data!', '', false);
    }

}

public function update(Request $request, $id)
    {

        // $this->validate($request, [
        //     'nama_paket' => 'required|max:100',
        //     'jenis_paket' => 'required|max:100',
        //     'deskripsi' => 'required|max:100',
        //     'id_vendor' => 'image|max:2048',
        //     'gambar_paket' => 'required|max:100'
        // ]);

        $update = Paket::where('id_paket', $id)
          ->update([
            'nama_paket' => $request->input('nama_paket'),
            'harga_paket' => $request->input('harga_paket'),
            'id_vendor' => $request->input('id_vendor'),
            'gambar_paket' => $request->input('gambar_paket')
          ]);
          if($update){
            return responData('Berhasil update data!', '', true);
        }else {
            return responData('Gagal update data!', '', false);
        }
    }

    public function show($id)
    {
        $data = Paket::find($id);
        if($data){
            return responData('Data didaptkan!', $data, true);
        }else {
            return responData('Data tidak ada', '', false);
        }
    }

    public function destroy($id){
        $delete = Paket::destroy($id);
        if($delete){
            return responData('Data berhasil dihapus!', '', true);
        }else {
            return responData('Data gagal dihapus!', '', false);
        }
    }
    
    }
