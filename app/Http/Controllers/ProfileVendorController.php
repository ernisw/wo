<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileVendorController extends Controller
{
    public function index(){
        $datas = User::paginate(5);
        return view('profilevendor.index')->with(['datas' => $datas]);
    }

}
