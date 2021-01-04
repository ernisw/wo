<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Layanan;
use DataTables;

class LayananController extends Controller
{
    public function index(){
        $datas = Layanan::paginate(5);
        return view('layanan.index')->with(['datas' => $datas]);

    }

    public function data(Request $request){
        $query = Layanan::query();
        return Datatables::eLoquent($query)
        ->addColumn('aksi', function ($item){
            $btn = '';
            $btn = '<button class="btn btn-primary btn-sm">ini tombol dengan id: '.$item->id_layanan.'</button>';
            return $btn;
        })
        ->addIndexColumn()
        ->escapeColumns([])
        ->toJson();
  
    }

    public function inputLayanan(){
        return view('layanan.forminputlayanan');
    }

    public function store(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        $insert = Layanan::insert($data);
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
        return redirect()->route('dataLayanan')->with($alert);
    }

    public function show($id) {
        $data = Layanan::where('id_layanan', $id)->first();
        
        return view('layanan.formeditlayanan')->with(['data' => $data]);
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        unset($data['_token']);
        $update = Layanan::where('id_layanan', $id)->update($data);
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
        return redirect()->route('dataLayanan')->with($alert);
    }

    public function delete ($id) {
        $delete = Layanan::where('id_layanan', $id)->delete();
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
        return redirect()->route('dataLayanan')->with($alert);
    }
}
