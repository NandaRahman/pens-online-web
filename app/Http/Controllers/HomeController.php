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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = User::all()->where('id','=', $user->id)->first();
        if($data->token_first_login != null || ''){
            return redirect()->route('user.password_reset');
        }
        return view('home');
    }

}
