<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index(){
        $datas = User::paginate(5);
        return view('profilewo.index')->with(['datas' => $datas]);
    }

   
    
}
