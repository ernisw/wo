<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class ApiVendor extends Controller
{
    public function getAllVendor () {
        $data = User::where('role', 'Vendor')->get();
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
}
