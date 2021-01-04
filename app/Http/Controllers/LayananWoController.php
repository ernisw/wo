<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Layanan;
use Illuminate\Support\Str;

class LayananWoController extends Controller
{
    public function index(){
        $datas = Layanan::where('id_vendor', auth()->user()->id)->  paginate(5);
        return view('layananwo.index')->with(['datas' => $datas]);

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

public function inputLayananWo(){
    return view('layananwo.forminputlayananwo');

}

public function store(Request $request) {
    $data = $request->all();
    $gambar = $request->file('gambar_layanan');

    $namafoto = Str::random(16) . round(microtime(true)) . '.' . $gambar->guessExtension();
    
    $gambar->move('img/fotoUser', $namafoto);
    $data['gambar_layanan']=$namafoto;
    unset($data['_token']);
    $data['id_vendor']=auth()->user()->id;
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
    return redirect()->route('dataLayananWO')->with($alert);
}

public function show($id) {
    $data = Layanan::where('id_layanan', $id)->first();
    
    return view('layananwo.formeditlayananwo')->with(['data' => $data]);
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
    return redirect()->route('dataLayananWO')->with($alert);
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
    return redirect()->route('dataLayananWO')->with($alert);
}

}
