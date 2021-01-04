<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paket;
use DataTables;

class PaketController extends Controller
{
        public function index(){
            $datas = Paket::paginate(5);
            return view('paket.index')->with(['datas' => $datas]);

    }

    public function data(Request $request){
        $query = Paket::query();
        return Datatables::eLoquent($query)
        ->addColumn('aksi', function ($item){
            $btn = '';
            $btn = '<button class="btn btn-primary btn-sm">ini tombol dengan id: '.$item->id_paket.'</button>';
            return $btn;
        })
        ->addIndexColumn()
        ->escapeColumns([])
        ->toJson();
  
    }

    public function inputPaket(){
        return view('paket.forminputpaket');

    }

    public function store(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        $insert = Paket::insert($data);
        $alert = [
            'afterAksi' => true
        ];
        if ($insert) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Input';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Input';
        }
        return redirect()->route('dataPaket')->with($alert);
    }

    public function show($id) {
        $data = Paket::where('id_paket', $id)->first();
        
        return view('paket.formeditpaket')->with(['data' => $data]);
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        unset($data['_token']);
        $update = Paket::where('id_paket', $id)->update($data);
        $alert = [
            'afterAksi' => true
        ];
        if ($update) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Update';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Update';
        }
        return redirect()->route('dataPaket')->with($alert);
    }

    public function delete ($id) {
        $delete = Paket::where('id_paket', $id)->delete();
        $alert = [
            'afterAksi' => true
        ];
        if ($delete) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Hapus';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Hapus';
        }
        return redirect()->route('dataPaket')->with($alert);
    }
}

