<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public const URL_HOST = "http://192.168.43.246/pens_local/api";
    public const ADMINISTRASI_AKADEMIK = "21";

    public function url($prefix,$data = []){
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents(self::URL_HOST.$prefix, false, $context);
        return $result;
    }

    public function auth($creditals = []){
        session()->put('status', true);
        session()->put('id',$creditals['id']);
        session()->put('email',$creditals['email']);
        session()->put('name',$creditals['name']);
        return true;
    }

    public function logout(){
//        session()->flush();
    }

    public function checkAuth(){
        if(!session()->get('status') === true){
            redirect()->route('login')->send();
        }
    }

    public function checkLogout(){
        if(session()->get('status') === true){
            redirect()->route('home')->send();
        }
    }

}
