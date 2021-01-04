<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Pembayaran;
use App\Layanan;
use App\Paket;
use Illuminate\Http\Request;

class ViewTransaksiController extends Controller
{
    public function index(){
        $datas = Pembayaran::select(
            'users.name AS name',
            'tb_pembayaran.*'
        )
                    ->join('users', 'users.id', '=', 'tb_pembayaran.id_user')
                    ->get()->toArray();
        $finaldata=array();

        for ($i=0; $i < sizeof($datas); $i++) {
            $detail = null;
            if ($datas[$i]['jenis'] === 'paket') {
                $detail = Paket::where('id_paket', $datas[$i]['id_item'])->first();
                if ($detail['id_wo'] === auth()->user()->id) {
                    $datas[$i]['detail'] = [
                        'namaItem' => $detail['nama_paket'],
                        'hargaItem' => $detail['harga_paket']
                    ];
                    array_push($finaldata, $datas[$i]);
                }
            } else{
                $detail = Layanan::where('id_layanan', $datas[$i]['id_item'])->first();
                if ($detail['id_wo'] === auth()->user()->id) {
                    $datas[$i]['detail'] = [
                        'namaItem' => $detail['nama_layanan'],
                        'hargaItem' => $detail['harga_layanan']
                    ];
                    array_push($finaldata, $datas[$i]);
                }
            }
        }

        // echo json_encode($finaldata);
        // echo json_encode(auth()->user()->id);
        return view('viewtransaksi.index')->with(['datas' => $finaldata]);
    }

    public function konfirmasi ($id) {
        $update = Pembayaran::where('id_bayar', $id)->update([
            'status' => 1
        ]);
        $alert = [
            'afterAksi' => true
        ];
        if ($update) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Konfirmasi';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Konfirmasi';
        }
        return redirect()->route('dataTransaksiView')->with($alert);
    }

    public function bukti ($id) {
        $update = Pembayaran::where('id_bayar', $id)->update([
            'status' => 1
        ]);
        $alert = [
            'afterAksi' => true
        ];
        if ($update) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Konfirmasi';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Konfirmasi';
        }
        return redirect()->route('dataTransaksiView')->with($alert);
    }
    public function konfirmasipembayaran  ($id){
        $update = Pembayaran::where('id_bayar', $id)->update([
            'status' => 3
        ]);
        $alert = [
            'afterAksi' => true
        ];
        if ($update) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Konfirmasi';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Konfirmasi';
        }
        return redirect()->route('dataTransaksiView')->with($alert);
    }
    public function buktibayar ($id) {
        $update = Pembayaran::where('id_bayar', $id)->update([
            'status' => 3   
        ]);
        // $alert = [
        //     'afterAksi' => true
        // ];
        // if ($update) {
        //     $alert['sukses'] = true;
        //     $alert['msg'] = 'Berhasil Konfirmasi';
        // } else {
        //     $alert['sukses'] = false;
        //     $alert['msg'] = 'Gagal Konfirmasi';
        // }
        // return redirect()->route('dataTransaksiView')->with($alert);
    }
}
