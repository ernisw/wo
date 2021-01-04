<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembayaran;
use App\Cart;
use App\Paket;
use App\Layanan;
use App\User;
use App\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PembayaranController extends Controller
{
    public function createTransaksi (Request $request){
        $data = $request->all()['data'];
        $tgl = $request->all()['tanggal_nikah'];
        $tanggal = strtotime($tgl);
        $date = date('Y-m-d', $tanggal);
        $dataGagal = array();
        for ($i=0; $i < sizeof($data); $i++) { 
            $ada = Pembayaran::where([
                ['id_item', $data[$i]['id_item']],
                ['tanggal_nikah', $date]
            ])->first();
            if ($ada) {
                array_push($dataGagal, $ada);
            } else {
                $create = Pembayaran::create([
                    'id_item' => $data[$i]['id_item'],
                    'id_user' => $data[$i]['id_user'],
                    'jenis' => $data[$i]['jenis'],
                    'tanggal_nikah' => $date
                ]);
                if ($create) {
                    Cart::where('id_cart', $data[$i]['id_cart'])->delete();
                }
            }
            
        }
        if (sizeof($dataGagal) > 0) {
            return json_encode([
                'status' => true,
                'all' => false,
                'pesan' => 'Berhasil Order Beberapa Item',
                'dataGagal' => $dataGagal
            ]);
        } else {
            return json_encode([
                'status' => true,
                'all' => true,
                'pesan' => 'Berhasil Order Semua Item',
                'dataGagal' => $dataGagal
            ]);
        }
    }

    public function getByUser($id) {
        $data = Pembayaran::where('id_user', $id)->get()->toArray();
        $newData = array();
        for ($i=0; $i < sizeof($data); $i++) { 
            $id = $data[$i]['id_item'];
            $detail=null;
            if ($data[$i]['jenis'] === 'paket') {
                $detail = Paket::where('id_paket', $id)
                        ->join('users', 'users.id', '=', 'tb_paket.id_wo')
                        ->first();
            } else {
                $detail = Layanan::where('id_layanan', $id)
                    ->join('users', 'users.id', '=', 'tb_layanan.id_vendor')
                    ->first();
            }
            $data[$i]['detail'] = $detail;
            array_push($newData, $data[$i]);
        }
        return json_encode([
            'data'=> $newData
        ]);
    }

    public function upload(Request $request, $id) {
        $image = $request->gambar;
        $imageName = Str::random(16) . round(microtime(true)) . '.' . $image->getClientOriginalExtension();
        $image->move('img/fotoUser', $imageName);

        $update = Pembayaran::where('id_bayar', $id)->update([
                'bukti_pembayaran' => $imageName,
                'status' => 2
        ]);
        $respon = null;
        if ($update) {
            $respon = [
                'sukses' => true,
                'pesan' => 'Berhasil Upload'
            ];
        } else {
            $respon = [
                'sukses' => false,
                'pesan' => 'Gagal Upload'
            ];
        }
        return json_encode($respon);
    }

    public function update (Request $request, $id) {
        $update = Pembayaran::where('id_bayar', $id)->update([
                'status' => 4
        ]);
        $respon = null;
        if ($update) {
            Rating::create([
                'id_user' => $request->id_user,
                'id_vendor_wo' => $request->id_vendor_wo,
                'nilai' => $request->rating
            ]);
            if($request->has('Kecepatan_waktu')){
                DB::table('tb_rating_kerja')->insert(
                    [
                        'jenis_mekanisme' => 'Kecepatan_waktu',
                        'nilai_rating' => $request->input('Kecepatan_waktu'),
                        'id_user' => $request->id_user,
                        'id_vendor_wo' => $request->id_vendor_wo,
                        ]
                );

            }
            if($request->has('Kerjasama_kru')){
                DB::table('tb_rating_kerja')->insert(
                    [
                        'jenis_mekanisme' => 'Kerjasama_kru',
                        'nilai_rating' => $request->input('Kerjasama_kru'),
                        'id_user' => $request->id_user,
                        'id_vendor_wo' => $request->id_vendor_wo,
                        ]
                );

            }

            if($request->has('Kerapihan')){
                DB::table('tb_rating_kerja')->insert(
                    [
                        'jenis_mekanisme' => 'Kerapihan',
                        'nilai_rating' => $request->input('Kerapihan'),
                        'id_user' => $request->id_user,
                        'id_vendor_wo' => $request->id_vendor_wo,
                        ]
                );

            }

            if($request->has('Detail')){
                DB::table('tb_rating_kerja')->insert(
                    [
                        'jenis_mekanisme' => 'Detail',
                        'nilai_rating' => $request->input('Detail'),
                        'id_user' => $request->id_user,
                        'id_vendor_wo' => $request->id_vendor_wo,
                        ]
                );

            }

            $ratingKecepatan = DB::table('tb_rating_kerja')->where('id_vendor_wo', $request->id_vendor_wo)->where('jenis_mekanisme', 'Kecepatan_waktu')->get()->toArray();
            $ratingKerjasama = DB::table('tb_rating_kerja')->where('id_vendor_wo', $request->id_vendor_wo)->where('jenis_mekanisme', 'Kerjasama_kru')->get()->toArray();
            $ratingKerapihan = DB::table('tb_rating_kerja')->where('id_vendor_wo', $request->id_vendor_wo)->where('jenis_mekanisme', 'Kerapihan')->get()->toArray();
            $ratingDetail = DB::table('tb_rating_kerja')->where('id_vendor_wo', $request->id_vendor_wo)->where('jenis_mekanisme', 'Detail')->get()->toArray();
            $rating = Rating::where('id_vendor_wo', $request->id_vendor_wo)->get()->toArray();

            $totalKecepatan = 0;
            for ($i=0; $i < sizeof($ratingKecepatan); $i++) { 
                $totalKecepatan += $ratingKecepatan[$i]->nilai_rating;
            }
            $totalKerjasama = 0;
            for ($i=0; $i < sizeof($ratingKerjasama); $i++) { 
                $totalKerjasama += $ratingKerjasama[$i]->nilai_rating;
            }
            $totalKerapihan = 0;
            for ($i=0; $i < sizeof($ratingKerapihan); $i++) { 
                $totalKerapihan += $ratingKerapihan[$i]->nilai_rating;
            }
            $totalDetail= 0;
            for ($i=0; $i < sizeof($ratingDetail); $i++) { 
                $totalDetail += $ratingDetail[$i]->nilai_rating;
            }

            $total = 0;
            for ($i=0; $i < sizeof($rating); $i++) { 
                $total += $rating[$i]['nilai'];
            }
            User::where('id', $request->id_vendor_wo)->update([
                'kecepatan' => $total / sizeof($rating),
                'kerjasama' => $total / sizeof($rating),
                'kerapihan' => $total / sizeof($rating),
                'detail_rating' => $total / sizeof($rating),
            ]);
            $respon = [
                'sukses' => true,
                'pesan' => 'Berhasil Menyelesaikan Transaksi'
            ];
        } else {
            $respon = [
                'sukses' => false,
                'pesan' => 'Gagal Menyelesaikan Transaksi'
            ];
        }
        return json_encode($respon);
    }
}
