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
        $this->middleware('guest');
    }

    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $prefix = "/staff/login";
        $data = [];
        $result= json_decode($this->url($prefix, $request->all()));
        if (!empty($result)){
            $credentials=array('email' => $result->email,'password' => $result->password,'status' => 'active');
            if(Auth::guard('users')->attempt($credentials))
                return redirect()->route('staff/home');
        }
        return redirect()->back();
    }
}
