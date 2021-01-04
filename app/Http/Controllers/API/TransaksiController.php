<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::all();
        if($data){
            return responData('Data didaptkan!', $data, true);
        }else{
            return responData('Data tidak ada', '', false);
        }
    }

    // public function getAllTransaksi () {
    //     $data = Transaksi::all();
    //     return json_encode([
    //         'sukses' => true,
    //         'data' => $data
    //     ]);
    // }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nama_paket' => 'required|max:100',
        //     'jenis_paket' => 'required|max:100',
        //     'deskripsi' => 'required|max:100',
        //     'id_vendor' => 'image|max:2048',
        //     'gambar_paket' => 'required|max:100'
        // ]);

        $insert = Transaksi::create([
            'id_pengguna' => $request->input('id_pengguna'),
            'id_vendor' => $request->input('id_vendor'),
            'nama_paket' => $request->input('nama_paket'),
            'nama_vendor' => $request->input('nama_vendor'),
            'total' => $request->input('total'),
            'set_tanggal_nikah' => $request->input('set_tanggal_nikah'),
            'gambar_vendor' => $request->input('gambar_vendor'),
            'status' => $request->input('status')

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

        $update = Transaksi::where('id_transaksi', $id)
          ->update([
            'id_pengguna' => $request->input('id_pengguna'),
            'id_vendor' => $request->input('id_vendor'),
            'nama_paket' => $request->input('nama_paket'),
            'nama_vendor' => $request->input('nama_vendor'),
            'total' => $request->input('total'),
            'set_tanggal_nikah' => $request->input('set_tanggal_nikah'),
            'gambar_vendor' => $request->input('gambar_vendor'),
            'status' => $request->input('status')
            
          ]);
          if($update){
            return responData('Berhasil update data!', '', true);
        }else {
            return responData('Gagal update data!', '', false);
        }
    }

    public function show($id)
    {
        $data = Transaksi::find($id);
        if($data){
            return responData('Data didaptkan!', $data, true);
        }else {
            return responData('Data tidak ada', '', false);
        }
    }

    public function destroy($id){
        $delete = Transaksi::destroy($id);
        if($delete){
            return responData('Data berhasil dihapus!', '', true);
        }else {
            return responData('Data gagal dihapus!', '', false);
        }
    }
    
    }
