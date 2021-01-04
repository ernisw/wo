<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Paket;
use App\Layanan;
use App\DetailPaket;
use Phpml\Classification\KNearestNeighbors;
use Illuminate\Support\Facades\DB;

class ApiWo extends Controller
{
    public function getAllWo () {
        $data = User::where('role', 'Wo')->get();
        if (sizeof($data) > 0) {
            return json_encode([
                'status'=> true,
                'data' => $data
            ]);
        } else {
            return json_encode([
                'status'=> false,
                'data' => []
            ]);
        }
        
    }

    public function getById (Request $request){
        $id = $request->id;
        $data = Paket::where('id_wo', $id)->get();
        if (sizeof($data) > 0) {
            return json_encode([
                'status'=> true,
                'data' => $data
            ]);
        } else {
            return json_encode([
                'status'=> false,
                'data' => []
            ]);
        }
    }
    public function getLayananByWo (Request $request){
        $id = $request->id;
        $data = Layanan::where('id_vendor', $id)->get();
        if (sizeof($data) > 0) {
            return json_encode([
                'status'=> true,
                'data' => $data
            ]);
        } else {
            return json_encode([
                'status'=> false,
                'data' => []
            ]);
        }
    }

    public function getDetail ($id){
        $data = User::where('id', $id)->first();
        $layanan = Layanan::where('id_vendor', $id)->get();
        $paket = Paket::where('id_wo', $id)->get();
        return json_encode([
            'data'=> $data,
            'layanan' => $layanan,
            'paket' => $paket
        ]); 
    }

    public function getdDetailPaket ($id) {
        $data = DetailPaket::where([
            ['id_paket', $id],
            ['statusKonfirmasi', 1]
        ])
                ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_detail_paket.id_layanan')
                ->get();
        $paket = Paket::where('id_paket', $id)->first();
        return json_encode([
            'paket' => $paket,
            'detail' => $data
        ]);
    }

    public function getknn (Request $request) {
        // ambil data layanan
        $x2 = (int) $request->budget;
        // // ambil nilai dari inputan rating (dari user)
        $y2= (int) $request->rating;
        // $w2= (int) $request->mekanisme;
        $kecepatan = $request->input('ratingKecepatan');
        $kerjasama = $request->input('ratingKerapihan');
        $kerapihan = $request->input('ratingKerjasama');
        $detail_rating = $request->input('ratingDetail');
        $pengalaman_req = explode('-',$request->input('pengalaman'));
        $dataLayanan = Layanan::join('users', 'users.id', '=', 'tb_layanan.id_vendor')->get()->toArray();
        $newLayanan = array();
        for ($i=0; $i < sizeof($dataLayanan); $i++) { 
            if ($dataLayanan[$i]['harga_layanan'] <= $x2) {
                $pengalaman = date("Y", strtotime($dataLayanan[$i]['pengalaman']));
                if((int)$pengalaman >= (int)$pengalaman_req[0] && (int)$pengalaman <= (int)$pengalaman_req[1]){
                    $ratingPengalaman = 5;
                } elseif((int)$pengalaman >= 2000 && (int)$pengalaman <= 2005){
                    $ratingPengalaman = 4;
                } elseif((int)$pengalaman >= 2005 && (int)$pengalaman <= 2010){
                    $ratingPengalaman = 3;
                } elseif((int)$pengalaman >= 2010 && (int)$pengalaman <= 2015){
                    $ratingPengalaman = 2;
                } elseif((int)$pengalaman >= 2015 && (int)$pengalaman <= 2022){
                    $ratingPengalaman = 1;
                }
                array_push($newLayanan, [
                    // bentuk data
                    'id'=> $dataLayanan[$i]['id_layanan'],
                    'harga' => (int) $dataLayanan[$i]['harga_layanan'],
                    'bobotHarga'=> abs($dataLayanan[$i]['harga_layanan'] - $x2),
                    'rating' => (int)$dataLayanan[$i]['rating'],
                    'rtg' => $dataLayanan[$i]['rating'] == $y2 ? 5 : abs($dataLayanan[$i]['rating'] - $y2),
                    // 'reputasi' => (int)$dataLayanan[$i]['reputasi'],
                    'pengalaman' => $ratingPengalaman,
                    // 'mekanisme' => $dataLayanan[$i]['mekanisme'] == $w2 ? 5 : abs($dataLayanan[$i]['mekanisme'] - $w2),
                    'kecepatan' => $dataLayanan[$i]['kecepatan'] == $kecepatan ? 5 : abs($dataLayanan[$i]['kecepatan'] - $kecepatan),
                    'kerjasama' => $dataLayanan[$i]['kerjasama'] == $kerjasama ? 5 : abs($dataLayanan[$i]['kerjasama'] - $kerjasama),
                    'kerapihan' => $dataLayanan[$i]['kerapihan'] == $kerapihan ? 5 : abs($dataLayanan[$i]['kerapihan'] - $kerapihan),
                    'detail_rating' => $dataLayanan[$i]['detail_rating'] == $detail_rating ? 5 : abs($dataLayanan[$i]['detail_rating'] - $detail_rating),
                    'jenis' => 'layanan',
                    'detail' => $dataLayanan[$i]
                ]);
            }
        }
        // ambil datapaket
        $dataPakt = Paket::join('users', 'users.id', '=', 'tb_paket.id_wo')->get()->toArray();
        $newPaket = array();
        for ($i=0; $i < sizeof($dataPakt); $i++) { 
            if ($dataPakt[$i]['harga_paket'] <= $x2) {
                $pengalaman = date("Y", strtotime($dataLayanan[$i]['pengalaman']));
                if((int)$pengalaman >= (int)$pengalaman_req[0] && (int)$pengalaman <= (int)$pengalaman_req[1]){
                    $ratingPengalaman = 5;
                } elseif((int)$pengalaman >= 2000 && (int)$pengalaman < 2005){
                    $ratingPengalaman = 4;
                } elseif((int)$pengalaman >= 2005 && (int)$pengalaman <= 2010){
                    $ratingPengalaman = 3;
                } elseif((int)$pengalaman >= 2010 && (int)$pengalaman <= 2015){
                    $ratingPengalaman = 2;
                } elseif((int)$pengalaman >= 2015 && (int)$pengalaman <= 2022){
                    $ratingPengalaman = 1;
                }
                array_push($newPaket, [
                    // bentuk datanya
                    'id'=> $dataPakt[$i]['id_paket'],
                    'harga' => (int)$dataPakt[$i]['harga_paket'],
                    'bobotHarga'=> abs($dataPakt[$i]['harga_paket'] - $x2),
                    'rating' => (int)$dataPakt[$i]['rating'],
                    'rtg' => $dataLayanan[$i]['rating'] == $y2 ? 5 : abs($dataLayanan[$i]['rating'] - $y2),
                    // 'reputasi' => (int)$dataLayanan[$i]['reputasi'],
                    'pengalaman' => $ratingPengalaman,
                    // 'mekanisme' => $dataLayanan[$i]['mekanisme'] == $w2 ? 5 : abs($dataLayanan[$i]['mekanisme'] - $w2),
                    'kecepatan' => $dataLayanan[$i]['kecepatan'] == $kecepatan ? 5 : abs($dataLayanan[$i]['kecepatan'] - $kecepatan),
                    'kerjasama' => $dataLayanan[$i]['kerjasama'] == $kerjasama ? 5 : abs($dataLayanan[$i]['kerjasama'] - $kerjasama),
                    'kerapihan' => $dataLayanan[$i]['kerapihan'] == $kerapihan ? 5 : abs($dataLayanan[$i]['kerapihan'] - $kerapihan),
                    'detail_rating' => $dataLayanan[$i]['detail_rating'] == $detail_rating ? 5 : abs($dataLayanan[$i]['detail_rating'] - $detail_rating),
                    'jenis' => 'paket',
                    'detail' => $dataPakt[$i]
                ]);
            }
        }
        // gabungkan data layanan dan data paket
        $finalData = array_merge($newLayanan, $newPaket);
        // return json_encode($finalData);
        $data= $finalData;
        // return (json_encode($data));

        usort($data, function($a,$b) {
                return strcmp($a['bobotHarga'],$b['bobotHarga']);
            }
        );

        for ($i=0; $i < sizeof($data); $i++) {
            $totalBobotHarga;
            if ($i == 0) {
                $totalBobotHarga = (10/10) * 0.3;   
            } else if ($i == 1) {
                $totalBobotHarga = (8/10) * 0.3;   
            } else if ($i == 2) {
                $totalBobotHarga = (6/10) * 0.3;   
            } else if($i == 3) {
                $totalBobotHarga = (4/10) * 0.3;   
            } else if ($i == 4) {
                $totalBobotHarga = (2/10) * 0.3;   
            } else {
                $totalBobotHarga = 0;   
            }
            $data[$i]['totalBobotHarga'] = $totalBobotHarga;
        }

        usort($data, function($a,$b) {
                return strcmp($a['rtg'],$b['rtg']);
            }
        );

        for ($i=0; $i < sizeof($data); $i++) {
            $ttl;
            if ($i == 0) {
                $ttl = (10/10) * 0.2;   
            } else if ($i == 1) {
                $ttl = (8/10) * 0.2;   
            } else if ($i == 2) {
                $ttl = (6/10) * 0.2;   
            } else if($i == 3) {
                $ttl = (4/10) * 0.2;   
            } else if ($i == 4) {
                $ttl = (2/10) * 0.2;   
            } else {
                $ttl = (1/10) * 0.2;   
            }
            $bobotRating = $ttl;
            // $totalBobotReputasi = $data[$i]['reputasi'] === 0 ? 0 * 0.2 : ($data[$i]['reputasi'] / 5) * 0.1;
            $totalBobotPengalaman = $data[$i]['pengalaman'] === 0 ? 0 * 0.2 : ($data[$i]['pengalaman'] / 5) * 0.15;
            $totalBobotkecepatan = $data[$i]['kecepatan'] === 0 ? 0 * 0.2 : ($data[$i]['kecepatan'] / 5) * 0.15;
            $totalBobotkerjasama = $data[$i]['kerjasama'] === 0 ? 0 * 0.2 : ($data[$i]['kerjasama'] / 5) * 0.15;
            $totalBobotkerapihan = $data[$i]['kerapihan'] === 0 ? 0 * 0.2 : ($data[$i]['kerapihan'] / 5) * 0.15;
            $totalBobotdetail_rating = $data[$i]['detail_rating'] === 0 ? 0 * 0.2 : ($data[$i]['detail_rating'] / 5) * 0.15;
            // $totalBobotMekanisme = $data[$i]['mekanisme'] === 0 ? 0 * 0.2 : ($data[$i]['mekanisme'] / 5) * 0.25;
            $total = $bobotRating + $data[$i]['totalBobotHarga'] + $totalBobotPengalaman + $totalBobotkecepatan + $totalBobotkerapihan + $totalBobotkerjasama + $totalBobotdetail_rating;
            $data[$i]['totalBobotRating'] = $bobotRating;
            // $data[$i]['totalBobotReputasi'] = $totalBobotReputasi;
            $data[$i]['totalBobotPengalaman'] = $totalBobotPengalaman;
            $data[$i]['totalBobotkecepatan'] = $totalBobotkecepatan;
            $data[$i]['totalBobotkerjasama'] = $totalBobotkerjasama;
            $data[$i]['totalBobotkerapihan'] = $totalBobotkerapihan;
            $data[$i]['totalBobotdetail_rating'] = $totalBobotdetail_rating;
            // $data[$i]['totalBobotMekanisme'] = $totalBobotMekanisme;
            $data[$i]['total'] = $total;
        }



        usort($data, function($a,$b) {
                return strcmp($b['total'],$a['total']);
            }
        );
        // return json_encode($data);
        // asort($smallest);
        // print key($smallest);

        // ambil nilai dari inputan budget (dari user)
        // $x2 = (int) $request->budget;
        // // ambil nilai dari inputan rating (dari user)
        // $y2= (int) $request->rating;
        // for ($i=0; $i < sizeof($data); $i++) {
        //     // ini rumus , sqrt = akar, (x * x) itu sama dengan kuadrat
        //     $data[$i]['res'] = sqrt(
        //         ($data[$i]['x1'] - $x2) * ($data[$i]['x1'] - $x2)
        //     ) + sqrt(
        //         ($data[$i]['y1'] - $y2) * ($data[$i]['y1'] - $y2)
        //     );
        // }
        // // urutkan data dari yang terdekat
        // usort($data, function($a,$b) {
        //         return strcmp($a['res'],$b['res']);
        //     }
        // );
        // // ambil 3 data terdekat
        $top_3_data = array_slice($data,0, 5);
        return json_encode($top_3_data);
    }

    public function getsaw(Request $request){
        $harga = $request->input('budget');
        $rating = $request->input('rating');
        $pengalaman = $request->input('pengalaman');
        $mekanisme = $request->input('mekanisme');
        $range_harga = explode('-', $harga);
        $paket = DB::table('tb_layanan')->join('users','users.id', '=', 'tb_layanan.id_vendor')
        ->where('users.role', 'Vendor')
        ->where('tb_layanan.harga_layanan', '>', $range_harga[0])
        ->where('tb_layanan.harga_layanan', '>', $range_harga[1])
        ->get();
        
        
    }
}