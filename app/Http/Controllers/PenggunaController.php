<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Pengguna;
use App\User;
use DataTables;
use Illuminate\Support\Str;

class PenggunaController extends Controller
{
    public function index(){
        $datas = User::where([
            ['role', '!=','Admin'],
            ['status', '=',1]
        ])->paginate(5);
        return view('pengguna.index')->with(['datas' => $datas]);
    }

    public function inputPengguna(){
        return view('pengguna.forminputpengguna');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        $respon = array();
        $data = json_decode($request->all()['data']);

        $image = $request->gambar;
        $imageName = Str::random(16) . round(microtime(true)) . '.' . $image->getClientOriginalExtension();
        $image->move('img/fotoUser', $imageName);

        $fotoUser = $request->foto;
        $fotoUserName = Str::random(16) . round(microtime(true)) . '.' . $fotoUser->getClientOriginalExtension();
        $fotoUser->move('img/fotoUser', $fotoUserName);

        $password = Hash::make($data->password);
        
        $cek = User::where('username', $data->username)->first();
        if($cek) {
            $respon = [
                'sukses' => false,
                'pesan' => 'Username Telah Terdaftar'
            ];
        } else {
            $input = User::create([
                'username' => $data->username,
                'name' => $data->name,
                'password' => $password,
                'email' => $data->email,
                'no_telp' => $data->no_telp,
                'alamat' => $data->alamat,
                'role' => $data->role,
                'gambar' => $imageName,
                'foto' => $fotoUserName
            ]);
            if ($input) {
                $respon = [
                    'sukses' => true,
                    'pesan' => 'Berhasil Registrasi'
                ];
            } else {
                $respon = [
                    'sukses' => false,
                    'pesan' => 'Gagal Registrasi'
                ];
            }
        }
        return response()->json($respon);
    }

    public function updateProfile(Request $request, $id)
    {
         
        $respon = array();
        $data = json_decode($request->all()['data']);

        $dataUpdate = [
            'name' => $data->name,
            'email' => $data->email,
            'no_telp' => $data->no_telp,
            'alamat' => $data->alamat
        ];

        if ($request->image !== null) {
            $image = $request->image;
            $imageName = Str::random(16) . round(microtime(true)) . '.' . $image->getClientOriginalExtension();
            $image->move('img/fotoUser', $imageName);
            $dataUpdate['gambar'] = $imageName;
        }

        $input = User::where('id',$id)->update($dataUpdate);
        if ($input) {
            $newprofile = User::where('id', $id)->first();
            $respon = [
                'sukses' => true,
                'pesan' => 'Berhasil Update',
                'profile' => $newprofile
            ];
        } else {
            $respon = [
                'sukses' => false,
                'pesan' => 'Gagal Update'
            ];
        }
        return response()->json($respon);
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        
        $respon = array();
        $user = User::where('username', $username)->first();
        if ($user) {
            // ada
            if (Hash::check($password, $user->password)) {
                $respon = [
                    'sukses' => true,
                    'pesan' => 'Berhasil Login',
                    'user' => $user
                ];
            } else {
                $respon = [
                    'sukses' => false,
                    'pesan' => 'Password Anda Salah',
                    'user' => null
                ];
            }
        } else {
            $respon = [
                'sukses' => false,
                'pesan' => 'Username Anda Salah',
                'user' => null
            ];
        }
        return json_encode($respon);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id) {
        $data = $request->all();
        unset($data['_token']);
        $update = User::where('id', $id)->update($data);
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
        return redirect()->route('dataPengguna')->with($alert);
   
        $file = $request->file('gambar_pengguna');
        $name = Str::random(16) . '.' . $file->guessExtension();
        $file->move('img', $name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $data = User::where('id_pengguna', $id)->first();
        
        return view('pengguna.formeditpengguna')->with(['data' => $data]);
    }

    public function data(Request $request){
        $query = User::query();
        return Datatables::eLoquent($query)
        ->addColumn('aksi', function ($item){
            $btn = '';
            $btn = '<button class="btn btn-primary btn-sm">ini tombol dengan id: '.$item->id.'</button>';
            return $btn;
        })
        ->addIndexColumn()
        ->escapeColumns([])
        ->toJson();
  
      }

      public function delete ($id) {
        $delete = User::where('id', $id)->delete();
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
        return redirect()->route('dataPengguna')->with($alert);
    }

    public function konfirmasiregis ($id){
        $update = User::where('id', $id)->update(['status' => 2]);
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
        return redirect()->route('dataPengguna')->with($alert);
    }

    public function tolakregis ($id){
        $update = User::where('id', $id)->update(['status' => 1]);
        $alert = $alert = [
            'afterAksi' => true
        ];
        if ($update) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Menolak';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Menolak';
        }
        return redirect()->route('dataPengguna')->with($alert);
    }

    public function belumproses ($id){
        $update = User::where('id', $id)->update(['status' => 0]);
        $alert = $alert = [
            'afterAksi' => true
        ];
        if ($update) {
            $alert['sukses'] = true;
            $alert['msg'] = 'Berhasil Menolak';
        } else {
            $alert['sukses'] = false;
            $alert['msg'] = 'Gagal Menolak';
        }
        return redirect()->route('dataPengguna')->with($alert);
    }

}
