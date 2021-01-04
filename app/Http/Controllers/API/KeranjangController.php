<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Keranjang;
use App\Layanan;
use App\Paket;
class KeranjangController extends Controller
{
    public function tambahKeranjang (Request $request) {
        $input = Keranjang::create($request->all());
        $respon = array();
        if ($input) {
            $respon = [
                'sukses' => true,
                'pesan' => 'Berhasil Menambah Keranjang Anda'
            ];
        } else {
            $respon = [
                'sukses' => false,
                'pesan' => 'Gagal Menambah Keranjang Anda'
            ];
        }
        return json_encode($respon);
    }

    public function getKeranjangByUser ($idUser) {
        $data = Keranjang::where('id_pengguna', $idUser)->get();
        $newData = array();
        for ($i=0; $i < sizeof($data); $i++) {
            $item = $data[$i];
            $detail = null;
            if ($data[$i] === 'paket') {
                $detail = Paket::join('tb_pengguna', 'tb_pengguna.id_pengguna', '=', 'tb_paket.id_vendor')->where('id_paket', $data[$i]['id_barang'])->get();
            } else {
                $detail = Layanan::join('tb_pengguna', 'tb_pengguna.id_pengguna', '=', 'tb_layanan.id_vendor')->where('id_layanan', $data[$i]['id_barang'])->get();
            }
            $item['detail'] =  $detail;
            // $item['nama_layanan'] = $detail['nama_layanan'];
            // $item['jenis_layanan'] = $detail['jenis_layanan'];
            // $item['nama_layanan'] = $detail['nama_layanan'];
            // $item['nama_layanan'] = $detail['nama_layanan'];
            array_push($newData, $item);
        }
        $respon = array();
        if ($data) {
            $respon = [
                'sukses' => true,
                'pesan' => 'Berhasil Memuat Data Keranjang Anda',
                'data' => $newData
            ];
        } else {
            $respon = [
                'sukses' => false,
                'pesan' => 'Data Keranjang Tidak Ada'
            ];
        }
        return json_encode($respon);
    }
}
