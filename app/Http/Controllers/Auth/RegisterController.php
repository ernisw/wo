<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_telp' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'foto' => ['required', 'mimes:jpeg,jpg,png', 'max:2048'],
            'gambar' => ['required', 'mimes:jpeg,jpg,png', 'max:2048'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        // $this->guard()->login($user);
        return $this->registered($request, $user)
                            ?: redirect($this->redirectPath());
    }
    protected function create(array $data)
    {

        $request = app('request');
            $foto = $request->file('foto');
            $gambar = $request->file('gambar');

            //nama file
            $namafoto = Str::random(16) . round(microtime(true)) . '.' . $foto->guessExtension();
            $namagambar = Str::random(16) . round(microtime(true)) . '.' . $gambar->guessExtension();
            
            //pindah folder
            $foto->move('img/fotoUser', $namafoto);
            $gambar->move('img/fotoUser', $namagambar);

        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
            'no_telp' => $data['no_telp'],
            'alamat' => $data['alamat'],
            'gambar' => $namagambar,
            'foto' => $namafoto,
            'pengalaman' => $data['pengalaman'],
        ]);
    
        
    }
}
