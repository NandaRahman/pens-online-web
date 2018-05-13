<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index(){
        $data = DB::table('absen as a')
            ->join('siswa as s', 'a.id_siswa','=','s.id')
            ->get();
        return view('user/report')->with('data', $data);
    }

}
