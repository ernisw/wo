<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Layanan;
use App\DetailPaket;
use Illuminate\Support\Str;

class LayananVendorController extends Controller
{
    public function index(){
        $datas = Layanan::where('id_vendor', auth()->user()->id)->  paginate(5);
        return view('layananvendor.index')->with(['datas' => $datas]);

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
        return view('layananvendor.forminputlayananvendor');
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['id_vendor']= auth()->user()->id;
        $gambar = $request->file('gambar_layanan');

        $namafoto = Str::random(16) . round(microtime(true)) . '.' . $gambar->guessExtension();
        
        $gambar->move('img/fotoUser', $namafoto);
        unset($data['_token']);
        
        $data['gambar_layanan']=$namafoto;
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
        return redirect()->route('dataLayananVendor')->with($alert);
    }

    public function show($id) {
        $data = Layanan::where('id_layanan', $id)->first();
        
        return view('layananvendor.formeditlayananvendor')->with(['data' => $data]);
    }

    public function update(Request $request, $id) {
        $data = $request->all();

        if ($request->file('gambar_layanan')) {
            $gambar = $request->file('gambar_layanan');
            $namafoto = Str::random(16) . round(microtime(true)) . '.' . $gambar->getClientOriginalExtension();
            
            $gambar->move('img/fotoUser', $namafoto);
            $data['gambar_layanan'] = $namafoto;
        } else {
            unset($data['gambar_layanan']);
        }

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
        return redirect()->route('dataLayananVendor')->with($alert);
    }

    public function pengajuankerjasama (){
        // $data= [
        //     'id_paket' => $idPaket,
        //     'id_layanan' => $idLayanan
        // ];
        $pengajuanLayanan = DetailPaket::where([
            ['tb_layanan.id_vendor', auth()->user()->id]
        ])
                    ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_detail_paket.id_layanan')
                    ->join('tb_paket', 'tb_paket.id_paket', '=', 'tb_detail_paket.id_paket')
                    ->join('users', 'users.id', '=', 'tb_paket.id_wo')
                    ->get();

        
        return view('layananvendor.pengajuankerjasama')->with(['datas' => $pengajuanLayanan]);

    }

    public function konfirmasi ($id){
        $update = DetailPaket::where('id_detail_paket', $id)->update(['statusKonfirmasi' => 1]);
        $alert = $alert = [
            'afterAksi' => true
        ];
        if ($update) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Konfirmasi';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Konfirmasi';
        }
        return redirect()->route('dataPengajuanKerjasama')->with($alert);
    }

    public function tolak ($id){
        $update = DetailPaket::where('id_detail_paket', $id)->update([
            'statusKonfirmasi' => 2
        ]);
        $alert = $alert = [
            'afterAksi' => true
        ];
        if ($update) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Menolak Tawaran';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Menolak Tawaran';
        }
        return redirect()->route('dataPengajuanKerjasama')->with($alert);
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
        return redirect()->route('dataLayananVendor')->with($alert);
    }
}
