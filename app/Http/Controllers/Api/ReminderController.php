<?php

namespace App\Http\Controllers\Api;

use App\Models\AbsensiMahasiswa;
use App\Models\Mahasiswa;
use App\Models\Nilai;
use App\Models\Reminder;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * @property Reminder pesan
 * @property mixed getPengguna
 */
class ReminderController extends Controller
{
    //Main Function For Login User
    function index(Request $request){
        $data = [];
        $prefix = "/mobile/reminder";
        $result= json_decode($this->url($prefix, $request->all()));
        if (sizeof((Array) $result)>0 && !empty($result)){
            foreach ($result as $val){
                 array_push($data,[
                        "nomor"=> $val->nomor,
                        "unik_tipe"=> $val->unik_tipe,
                        "untuk"=> $val->untuk,
                        "pengguna"=> $val->pengguna,
                        "judul"=> $val->judul,
                        "tanggal_buat"=> $val->tanggal_buat,
                        "tanggal_kirim"=>$val->tanggal_kirim,
                        "status"=> $val->status,
                        "pesan"=>$val->pesan,
                    ]);
            }
            return response()->json($data);
        }
        return 0;
    }

    function create(Request $request){
        $prefix = "/mobile/reminder";
        $result= json_decode($this->url($prefix, $request->all()));
        if (sizeof((Array) $result)>0){
            return response()->json($result);
        }
        return 0;
    }
}
