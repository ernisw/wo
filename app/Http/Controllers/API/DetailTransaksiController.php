<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DetailTransaksi;

class DetailTransaksiController extends Controller
{
    public function index(Request $request)
    {
        $data = DetailTransaksi::paginate($request->get('page'));
        if($data){
            return responData('Data didaptkan!', $data, true);
        }else{
            return responData('Data tidak ada', '', false);
        }
}

public function store(Request $request)
    {
        // $this->validate($request, [
        //     'id_transaksi' => 'required|max:100',
        //     'id_layanan' => 'required|max:100'
        // ]);

        $insert = DetailTransaksi::create([
            'id_transaksi' => $request->input('id_transaksi'),
            'id_layanan' => $request->input('id_layanan')

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
        //     'id_transaksi' => 'required|max:100',
        //     'id_layanan' => 'required|max:100'
        // ]);

        $update = DetailTransaksi::where('id_detail_transaksi', $id)
          ->update([
            'id_transaksi' => $request->input('id_transaksi'),
            'id_layanan' => $request->input('id_layanan')
          ]);
          if($update){
            return responData('Berhasil update data!', '', true);
        }else {
            return responData('Gagal update data!', '', false);
        }
    }

    public function show($id)
    {
        $data = DetailTransaksi::find($id);
        if($data){
            return responData('Data didaptkan!', $data, true);
        }else {
            return responData('Data tidak ada', '', false);
        }
    }

    public function destroy($id){
        $delete = DetailTransaksi::destroy($id);
        if($delete){
            return responData('Data berhasil dihapus!', '', true);
        }else {
            return responData('Data gagal dihapus!', '', false);
        }
    }
}
