<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vendor;
use App\User;
use App\Layanan;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $data = Vendor::paginate($request->get('page'));
        if($data){
            return responData('Data didaptkan!', $data, true);
        }else{
            return responData('Data tidak ada', '', false);
        }

    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nama_vendor' => 'required|max:100',
        //     'alamat' => 'required|max:100',
        //     'no_hp' => 'required|max:100',
        //     'gambar_vendor' => 'image|max:2048',
        //     'long' => 'required|max:100',
        //     'lat' => 'required|max:100'
        // ]);
        $insert = Vendor::create([
            'nama_vendor' => $request->input('nama_vendor'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'gambar_vendor' => $request->input('gambar_vendor')
           

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
        //     'nama_vendor' => 'required|max:100',
        //     'alamat' => 'required|max:100',
        //     'no_hp' => 'required|max:100',
        //     'gambar_vendor' => 'image|max:2048',
        //     'long' => 'required|max:100',
        //     'lat' => 'required|max:100'
        // ]);

        $update = Vendor::where('id_vendor', $id)
          ->update([
            'nama_vendor' => $request->input('nama_vendor'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'gambar_vendor' => $request->input('gambar_vendor')
           
          ]);

          if($update){
            return responData('Berhasil update data!', '', true);
        }else {
            return responData('Gagal update data!', '', false);
        }
    }
    public function show($id)
    {
        $data = User::find($id);
        $layanan = Layanan::where('id_vendor', $id)->get();
        if($data){
            return json_encode([
                'data' => $data,
                'layanan' => $layanan
            ]);
            // return responData('Data didaptkan!', $data, true);
        }else {
            return responData('Data tidak ada', '', false);
        }
    }

    public function destroy($id){
        $delete = Vendor::destroy($id);
        if($delete){
            return responData('Data berhasil dihapus!', '', true);
        }else {
            return responData('Data gagal dihapus!', '', false);
        }
    }

    public function showAllvVendor (){
        $data = Vendor::all();
        return json_encode([
            "status" => true,
            "vendor" => $data
        ]);
    }
}
