<?php

namespace App\Http\Controllers;

use App\Layanan;
use Illuminate\Http\Request;
use App\Pembayaran;

class Transaksi1Controller extends Controller
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
            if ($datas[$i]['jenis'] === 'layanan') {
                $detail = Layanan::where('id_layanan', $datas[$i]['id_item'])->first();
                if ($detail['id_vendor'] === auth()->user()->id) {
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

    public function konfirmasiByVendor ($id) {
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
        return redirect()->route('dataTransaksi1')->with($alert);
    }
    public function konfirmasiPembayaranByVendor ($id) {
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
        return redirect()->route('dataTransaksi1')->with($alert);
    }
   
    public function bukti2 ($id) {
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
    public function buktibayar1 ($id) {
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
    public function buktibayar ($id) {
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
}
