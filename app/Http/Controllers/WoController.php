<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class WoController extends Controller
{
    public function index(){
        $datas = User::where('role','WO')->paginate(5);
        return view('wo.index')->with(['datas' => $datas]);
    }

public function inputPaket(){
    return view('wo.forminputwo');

}

public function store(Request $request) {
    $data = $request->all();
    $foto = $request->file('foto');
    $gambar = $request->file('gambar');

    //nama file
    $namafoto = Str::random(16) . round(microtime(true)) . '.' . $foto->guessExtension();
    $namagambar = Str::random(16) . round(microtime(true)) . '.' . $gambar->guessExtension();
    
    //pindah folder
    $foto->move('img/fotoUser', $namafoto);
    $gambar->move('img/fotoUser', $namagambar);
    // unset($data['_token']);
    $insert = User::insert([
        'username' => $data['username'],
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'no_telp' => $data['no_telp'],
        'alamat' => $data['alamat'],
        'foto' => $namafoto,
        'gambar' => $namagambar,
    ]);
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
    return redirect()->route('dataWO')->with($alert);
}

public function show($id) {
    $data = User::where('id', $id)->first();
    
    return view('wo.formeditwo')->with(['data' => $data]);
}

public function update(Request $request, $id) {
    $data = $request->all();
    unset($data['_token']);

    $foto = $request->file('foto');
    $gambar = $request->file('gambar');
    $dataLama = User::where('id', $id)->first();
    $editFoto = false;
    $editGambar = false;
    if($foto){
        $namafoto = Str::random(16) . round(microtime(true)) . '.' . $foto->guessExtension();
        $foto->move('img/fotoUser', $namafoto);
        $data['foto'] = $namafoto;
        $editFoto = true;
    }

    if($gambar){
        $namagambar = Str::random(16) . round(microtime(true)) . '.' . $gambar->guessExtension();    
        $gambar->move('img/fotoUser', $namagambar);
        $data['gambar'] = $namagambar;
        $editGambar=true;
    }
    
    $update = User::where('id', $id)->update($data);
    $alert = [
        'afterAksi' => true
    ];
    if ($update) {
        if ($editFoto) {
           unlink('img/fotoUser/' . $dataLama['foto']);
        }
        if ($editGambar) {
            unlink('img/fotoUser/' .$dataLama['gambar']);
         }
        $alert['sukses'] = true;
        $alert['msg'] = 'Berhasil Update';
    } else {
        $alert['sukses'] = false;
        $alert['msg'] = 'Gagal Update';
    }
    return redirect()->route('dataWO')->with($alert);
}

public function delete ($id) {
    $dataLama = User::where('id', $id)->first();
    $delete = User::where('id', $id)->delete();
    $alert = [
        'afterAksi' => true
    ];
    if ($delete) {
           
        unlink('img/fotoUser/' . $dataLama['foto']);
        unlink('img/fotoUser/' .$dataLama['gambar']);
        $alert['sukses'] = true;
        $alert['msg'] = 'Berhasil Hapus';
    } else {
        $alert['sukses'] = false;
        $alert['msg'] = 'Gagal Hapus';
    }
    return redirect()->route('dataWO')->with($alert);
}

}
