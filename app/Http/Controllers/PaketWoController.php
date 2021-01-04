<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paket;
use App\DetailPaket;
use App\Layanan;
use App\User;
use Illuminate\Support\Str;

class PaketWoController extends Controller
{
    public function index(){
        $datas = Paket::where('id_wo', auth()->user()->id)->  paginate(5);
        return view('paketwo.index')->with(['datas' => $datas]);

    }

    public function inputPaketWo(){
        return view('paketwo.forminputwo');
    }

    public function store(Request $request) {
        $data = $request->all(); 
        $gambar = $request->file('gambar_paket');
        $data['id_wo']= auth()->user()->id;

        //nama file
     
            $namafoto = Str::random(16) . round(microtime(true)) . '.' . $gambar->getClientOriginalExtension();
         
        
        //pindah folder
        $gambar->move('img/fotoUser', $namafoto);
        unset($data['_token']);
        $data['gambar_paket']=$namafoto;
        $data['id_wo'] = auth()->id();
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
        return redirect()->route('dataPaketWo')->with($alert);
    }

    public function tambahLayanan ($idPaket) {
        $data = Layanan::join('users', 'tb_layanan.id_vendor','=', 'users.id')
                    ->paginate(10);
        return view('paketwo.tambahlayanan')->with(['datas' => $data, 'idPaket' => $idPaket]);
    }

    public function detailPaket ($idPaket) {
        $data = DetailPaket::where('tb_detail_paket.id_paket', $idPaket)
                    ->join('tb_layanan', 'tb_layanan.id_layanan','=', 'tb_detail_paket.id_layanan')
                    ->join('users', 'tb_layanan.id_vendor','=', 'users.id')
                    ->paginate(10);
        $paket= Paket::where('id_paket', $idPaket)->first();
        $jumlahLayanan = sizeof(DetailPaket::where([
            ['id_paket', $idPaket],
            ['statusKonfirmasi', 1]
        ])->get()->toArray());
        return view('paketwo.detailpaket')->with(['datas' => $data, 'paket' => $paket, 'jumlahLayanan' => $jumlahLayanan]);
    }

    public function getProfileVendor ($id) {
        $data = User::where('id', $id)->first();
        return view('viewvendor.index')->with(['data' => $data]);
    }
    

    public function tambahLayananKePaket ($idPaket, $idLayanan){
        $data= [
            'id_paket' => $idPaket,
            'id_layanan' => $idLayanan
        ];
        $dataLayanan = Layanan::where('id_layanan', $idLayanan)->first();
        if($dataLayanan->id_vendor === auth()->user()->id){
            $data['statusKonfirmasi'] = 1;
        }
        $insert = DetailPaket::insert($data);
        $alert = [
            'afterAksi' => true
        ];
        if ($insert) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Mengajukan Kerja Sama';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Mengajukan Kerja Sama';
        }
        return redirect()->route('dataPaketWo')->with($alert);

    }
    //dataPaketWo
    public function editpaket($id) {
        $data = Paket::where('id_paket', $id)->first();
        
        return view('paketwo.formeditpaket')->with(['data' => $data]);
    }
   
    

    public function update(Request $request, $id) {
        $data = $request->all();

        if ($request->file('gambar_paket')) {
            $gambar = $request->file('gambar_paket');
            $namafoto = Str::random(16) . round(microtime(true)) . '.' . $gambar->getClientOriginalExtension();
            
            $gambar->move('img/fotoUser', $namafoto);
            $data['gambar_paket'] = $namafoto;
        } else {
            unset($data['gambar_paket']);
        }

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
        return redirect()->route('dataPaketWo')->with($alert);
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
        return redirect()->route('dataPaketWo')->with($alert);
    }
}
