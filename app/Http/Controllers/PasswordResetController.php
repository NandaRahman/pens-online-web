<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user_id = Auth::user()->id;
        return view('auth/reset')->with('id',$user_id);
    }

    public function resetPassword(Request $request){
        $validate = $this->passwordValidation($request);
        if ($validate === true){
            DB::table('users')->where('id','=',$request->id)->update([
                'password'=>Hash::make($request->password),
                'token_first_login'=>''
            ]);
            return redirect()->route('user.home');
        }else{
            return $validate;
        }
    }

    public function  passwordValidation($request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->route('user.password_reset')
                ->withErrors($validator)
                ->withInput();
        }
        return true;
    }

}
