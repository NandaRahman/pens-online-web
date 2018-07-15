<?php

namespace App\Http\Controllers\Api;

use App\Models\Mahasiswa;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    public function mahasiswa(Request $request){//mahasiswa, kelas, kuliah
        $prefix = "/mahasiswa/profil";
        $result= json_decode($this->url($prefix, $request->all()));
        if (sizeof((Array) $result)>0){
            $data=[
                "nomor"=>$result->nomor,
                "nrp"=>$result->nrp,
                "nama"=>$result->nama,
                "status"=>$result->status,
                "no_telp"=>$result->no_telp,
                "wali_kelas"=>$result->get_kelas->get_wali_kelas->nama,
                "program"=>$result->get_kelas->get_program->program,
                "jurusan"=>$result->get_kelas->get_jurusan->jurusan,
                "kelas"=>$result->get_kelas->kelas,
                "pararel"=>$result->get_kelas->pararel,
            ];
            return response()->json($data);
        }
        return 0;
    }

    public function pegawai(Request $request){//pegawai
        $prefix = "/pegawai/profil";
        $result= json_decode($this->url($prefix, $request->all()));
        if (sizeof((Array) $result)>0){
            return response()->json($result);
        }
        return 0;
    }

    public function editNoTelp(Request $request){//pegawai
        $prefix = "/mobile/phone:edit";
        $result= json_decode($this->url($prefix, $request->all()));
        if (sizeof((Array) $result)>0){
            return response()->json($result);
        }
        return 0;
    }

    //
}
