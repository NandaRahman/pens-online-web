<?php

namespace App\Http\Controllers\Api;

use App\Models\Absensikaryawan;
use App\Models\Mahasiswa;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbsensiController extends Controller
{
    public function mahasiswa(Request $request){//mahasiswa,  kuliah
        $prefix = "/mahasiswa/absen";
        $result= json_decode($this->url($prefix, $request->all()));
        if (sizeof((Array) $result)>0){
			foreach($result as $val)
            return response()->json($val);
        }
        return 0;
    }

    public function pegawai(Request $request){//pegawai
        $data = [];
        $prefix = "/pegawai/absen";
        $result= json_decode($this->url($prefix, $request->all()));
        if (sizeof((Array) $result)>0){
            foreach ($result as $val){
                array_push($data,[
                    "nomor"=>$val->pegawai,
                    "nama"=>$val->get_pegawai->nama,
                    "no_telp"=>$val->get_pegawai->notelp,
                    "staff"=>$val->get_pegawai->get_staff->staff,
                    "masuk"=>$val->masuk,
                    "pulang"=>$val->pulang,
                    "pulangawal"=>$val->pulangawal,
                    "terlambat1"=>$val->terlambat1,
                    "terlambat2"=>$val->terlambat2,
                    "tidakabsen"=>$val->tidakabsen,
                    "tidakmasuk"=>$val->tidakmasuk,
                    "libur"=>$val->libur,
                    "lembur"=>$val->lembur,
                    "tanggal"=>$val->tanggal,
                ]);
            }
            return response()->json($data);
        }
        return 0;
    }

}
