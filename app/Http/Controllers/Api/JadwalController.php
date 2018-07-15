<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JadwalController extends Controller
{
    public function mahasiswa(Request $request){//nomor_mahasiswa
        $prefix = "/mahasiswa/jadwal";
        $data = [];
        $result= json_decode($this->url($prefix, $request->all()));
        if (sizeof((Array) $result)>0){
            foreach ($result as $val){
                array_push($data,[
                    "kuliah"=>$val->nomor,
                    "dosen"=>$val->get_dosen->nama,
                    "tahun"=>$val->tahun,
                    "semester"=>$val->semester,
                    "hari"=>$val->get_hari->hari,
                    "jam"=>$val->get_jam->jam,
                    "matakuliah"=>$val->get_matakuliah->matakuliah,
                    "jam_kuliah"=>$val->get_matakuliah->jam,
                    "sks"=>$val->get_matakuliah->sks,
                ]);

            }
            return response()->json($data);
        }
        return 0;
    }
}
