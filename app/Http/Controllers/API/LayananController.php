<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Layanan;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $data = Layanan::paginate($request->get('page'));
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
        $insert = Layanan::create([
            'nama_layanan' => $request->input('nama_layanan'),
            'jenis_layanan' => $request->input('jenis_layanan'),
            'harga' => $request->input('harga'),
            'id_vendor' => $request->input('id_vendor'),
            'id_paket' => $request->input('id_paket'),
            'gambar_layanan' => $request->input('gambar_layanan')

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

        $update = Layanan::where('id_layanan', $id)
          ->update([
            'nama_layanan' => $request->input('nama_layanan'),
            'jenis_layanan' => $request->input('jenis_layanan'),
            'harga' => $request->input('harga'),
            'id_vendor' => $request->input('id_vendor'),
            'id_paket' => $request->input('id_paket'),
            'gambar_layanan' => $request->input('gambar_layanan')
          ]);

          if($update){
            return responData('Berhasil update data!', '', true);
        }else {
            return responData('Gagal update data!', '', false);
        }
    }

    public function show($id)
    {
        $data = Layanan::find($id);
        if($data){
            return responData('Data didaptkan!', $data, true);
        }else {
            return responData('Data tidak ada', '', false);
        }
    }

    public function destroy($id){
        $delete = Layanan::destroy($id);
        if($delete){
            return responData('Data berhasil dihapus!', '', true);
        }else {
            return responData('Data gagal dihapus!', '', false);
        }
    }

}
