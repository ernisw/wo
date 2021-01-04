<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PaketVendor;

class PaketVendorController extends Controller
{
    public function index()
    {
        $data = PaketVendor::all();
        if($data){
            return responData('Data didaptkan!', $data, true);
        }else{
            return responData('Data tidak ada', '', false);
        }
    }

        public function getAllPaketVendor () {
            $data = PaketVendor::all();
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
    
            $insert = PaketVendor::create([
                'nama_paket_vendor' => $request->input('nama_paket_vendor'),
                'list_paket' => $request->input('list_paket'),
                'harga_paket_vendor' => $request->input('harga_paket_vendor'),
                'gambar_paket_vendor' => $request->input('gambar_paket_vendor')
    
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
    
            $update = PaketVendor::where('id_paket_vendor', $id)
              ->update([
                'nama_paket_vendor' => $request->input('nama_paket_vendor'),
                'list_paket' => $request->input('list_paket'),
                'harga_paket_vendor' => $request->input('harga_paket_vendor'),
                'gambar_paket_vendor' => $request->input('gambar_paket_vendor')
              ]);
              if($update){
                return responData('Berhasil update data!', '', true);
            }else {
                return responData('Gagal update data!', '', false);
            }
        }
    
        public function show($id)
        {
            $data = PaketVendor::find($id);
            if($data){
                return responData('Data didaptkan!', $data, true);
            }else {
                return responData('Data tidak ada', '', false);
            }
        }
    
        public function destroy($id){
            $delete = PaketVendor::destroy($id);
            if($delete){
                return responData('Data berhasil dihapus!', '', true);
            }else {
                return responData('Data gagal dihapus!', '', false);
            }
        }
}
