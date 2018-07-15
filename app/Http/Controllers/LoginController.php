<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->checkLogout();
            return $next($request);
        });

    }

    public function index(){
        return view('auth/login');
    }

    public function login(Request $request){
        $prefix = "/staff/login";
        $data = [];
        $result= json_decode($this->url($prefix, $request->all()));
        if (!empty($result)){
            if($result->get_identity->staff == self::ADMINISTRASI_AKADEMIK){
                $credentials=array(
                    'id' => $result->nomor,
                    'email' => $result->email,
                    'name' => $result->get_identity->nama
                );
                if($this->auth($credentials))
                    return redirect()->route('home');
            }
        }
        return redirect()->back();
    }

    public function signout(){
        $this->logout();
        return redirect()->back();
    }

}
