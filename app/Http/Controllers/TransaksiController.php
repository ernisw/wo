<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;

class TransaksiController extends Controller
{
    public function index(){
        $datas = Transaksi::join('tb_pengguna', 'tb_transaksi.id_pengguna', '=', 'tb_pengguna.id_pengguna')
            ->select(
                    'tb_transaksi.id_transaksi',
                    'tb_transaksi.nama_paket',
                    'tb_transaksi.total',
                    'tb_transaksi.set_tanggal_nikah',
                    'tb_transaksi.status',
                    'tb_pengguna.id_pengguna',
                    'tb_pengguna.nama_lengkap',
                    'tb_pengguna.no_telp',
                    'tb_pengguna.email',
                    )->Paginate(5);;
        return view('transaksi.index')->with(['datas' => $datas]);
        // return json_encode($datas);
    }

    public function inputTransaksi(){
        return view('transaksi.forminputtransaksi');

    }

    public function store(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        $insert = Transaksi::insert($data);
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
        return redirect()->route('dataTransaksi')->with($alert);
    }

    public function show($id) {
        $data = Transaksi::where('id_transaksi', $id)->first();
        
        return view('transaksi.formedittransaksi')->with(['data' => $data]);
    }

   
    public function status1(request $request, $id)
    {
        $data = $request->all();
        $ganti = 'Batal';
        $data['status'] = $ganti;
        $update = Transaksi::where('id_transaksi', $id)->update($data);
            $alert = [
                'afterAksi' => true
            ];
            if ($update) {
                $alert['sukses'] = true;
                $alert['msg'] = 'Berhasil Diubah';
            } else {
                $alert['sukses'] = false;
                $alert['msg'] = 'Gagal Diubah';
            }
            return redirect()->route('dataTransaksi')->with($alert);
        return json_encode($data);
    }

    public function status2(request $request, $id)
    {
        $data = $request->all();
        $ganti = 'Proses';
        $data['status'] = $ganti;
        $update = Transaksi::where('id_transaksi', $id)->update($data);
            $alert = [
                'afterAksi' => true
            ];
            if ($update) {
                $alert['sukses'] = true;
                $alert['msg'] = 'Berhasil Diubah';
            } else {
                $alert['sukses'] = false;
                $alert['msg'] = 'Gagal Diubah';
            }
            return redirect()->route('dataTransaksi')->with($alert);
        return json_encode($data);
    }

    public function status3(request $request, $id)
    {
        $data = $request->all();
        $ganti = 'Selesai';
        $data['status'] = $ganti;
        $update = Transaksi::where('id_transaksi', $id)->update($data);
            $alert = [
                'afterAksi' => true
            ];
            if ($update) {
                $alert['sukses'] = true;
                $alert['msg'] = 'Berhasil Diubah';
            } else {
                $alert['sukses'] = false;
                $alert['msg'] = 'Gagal Diubah';
            }
            return redirect()->route('dataTransaksi')->with($alert);
        return json_encode($data);
    }


    public function update(Request $request, $id) {
        $data = $request->all();
        unset($data['_token']);
        $update = Transaksi::where('id_transaksi', $id)->update($data);
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
        return redirect()->route('dataTransaksi')->with($alert);
    }

    public function delete ($id) {
        $delete = Transaksi::where('id_transaksi', $id)->delete();
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
        return redirect()->route('dataTransaksi')->with($alert);
    }
}

