<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class HomeController extends Controller
{
    use EntrustUserTrait; // add this trait to your user model

    var $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
        $func = new AbsenceController();
        $func->init();
        $data = User::all()->where('id','=', $func->user->id)->first();
        if($data->token_first_login != null || ''){
            return redirect()->route('user.password_reset');
        }
        if (!$func->user->hasRole('admin')){
            $func->call();
            if ($func->check_active){

            }else{
                $data = $func->setDetailedAbsence();
                if ($data){
                    return view('home')->with('data',$data);
                }
            }
        }
        return view('home');
    }



}
