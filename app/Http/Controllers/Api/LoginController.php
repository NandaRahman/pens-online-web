<?php

namespace App\Http\Controllers\Api;

use App\Models\LoginMahasiswa;
use App\Models\LoginPegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    const STATE_LECTURER = 0;
    const STATE_STUDENT = 1;

    //Main Function For Login User
    function index(Request $request){
        $prefix = "/mobile/login";
        $result= json_decode($this->url($prefix, $request->all()));
        if ($result->status == "success"){
            return response()->json($result);
        }
        return 0;
    }
}
