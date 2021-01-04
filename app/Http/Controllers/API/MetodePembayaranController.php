<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MetodePembayaran;


class MetodePembayaranController extends Controller
{
    public function index(Request $request)
    {
        $data = MetodePembayaran::paginate($request->get('page'));
        if($data){
            return responData('Data didaptkan!', $data, true);
        }else{
            return responData('Data tidak ada', '', false);
        }
}
public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nama_layanan' => 'required|max:100',
        //     'jenis_layanan' => 'required|max:100',
        //     'harga' => 'required|max:100',
        //     'id_vendor' => 'image|max:2048',
        //     'id_paket' => 'required|max:100',
        //     'gambar_layanan' => 'required|max:100'
        // ]);
        $insert = MetodePembayaran::create([
            'nama_bank' => $request->input('nama_bank')
           
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
        //     'nama_layanan' => 'required|max:100',
        //     'jenis_layanan' => 'required|max:100',
        //     'harga' => 'required|max:100',
        //     'id_vendor' => 'image|max:2048',
        //     'id_paket' => 'required|max:100',
        //     'gambar_layanan' => 'required|max:100'
        // ]);

        $update = MetodePembayaran::where('id_metode_pembayaran', $id)
          ->update([
            'nama_bank' => $request->input('nama_bank')
        
          ]);

          if($update){
            return responData('Berhasil update data!', '', true);
        }else {
            return responData('Gagal update data!', '', false);
        }
    }

    public function show($id)
    {
        $data = MetodePembayaran::find($id);
        if($data){
            return responData('Data didaptkan!', $data, true);
        }else {
            return responData('Data tidak ada', '', false);
        }
    }

    public function destroy($id){
        $delete = MetodePembayaran::destroy($id);
        if($delete){
            return responData('Data berhasil dihapus!', '', true);
        }else {
            return responData('Data gagal dihapus!', '', false);
        }
    }
}
