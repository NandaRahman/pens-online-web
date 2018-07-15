<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pegawai;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index(){
        return view('reminder/index');
    }

    public function add(){
        $mahasiswa = $this->mahasiswa();
        $pegawai = $this->pegawai();
        return view('reminder/create')
            ->with('mahasiswa', $mahasiswa)
            ->with('pegawai', $pegawai);
    }

    public function delete($nomor){
        $prefix = "/staff/reminder:delete";
        $result= json_decode($this->url($prefix,["nomor"=>$nomor]));
        return redirect()->back();
    }


    public function create(Request $request){
        $prefix = "/staff/reminder:create";
        $result= json_decode($this->url($prefix, $request->all()));
        return redirect()->route('reminder');
    }

    public function mahasiswa(){
        $prefix = "/mahasiswa/get";
        $result= json_decode($this->url($prefix));
        return $result;
    }

    public function pegawai(){
        $prefix = "/pegawai/get";
        $result= json_decode($this->url($prefix));
        return $result;
    }

    public function get(Request $request){
        $prefix = "/staff/reminder:get";
        $result= json_decode($this->url($prefix, $request->all()));
        $data = "";
        $i = 1;
        foreach ($result as $val){
            if (empty($val->tanggal_kirim)){
                $message = 0;
            }else{
                $message = 1;
            }
            $data .= "
                <tr>
                    <td>".$i++."</td>";
            if($val->untuk == 1)
                $data.= "
                    <td>Mahasiswa</td>
                    ";
            else
                $data.= "
                    <td>Pegawai</td>
                    ";
            $data .= "
                    <td>".date('Y-m-d', strtotime($val->tanggal_buat))."</td>
                    <td>
                        <div class='row'>
                            <div class='col-sm-12 text-left'>
                                <b>Kepada :</b> ".$val->get_pengguna->nama."
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12 text-left'>
                            ".$val->judul."
                            </div>
                        </div>                        
                        <div class='row'>
                            <div class='col-sm-12 text-left'>
                                ".$val->pesan."
                            </div>
                        </div>
                    </td>";
            if($val->status == 1)
                $data.= "
                    <td class='text-center'> <span class=\"label label-success\">Terkirim</span></td>
                    ";
            else
                $data.= "
                    <td class='text-center'> <span class=\"label label-warning\">Belum</span></td>
                    ";
            $data.= "
                    <td class='text-center'><a href='".route('reminder:delete',[$val->nomor])."'><button class=\"btn btn-danger\">Hapus</button></a></td>
                    ";
            $data.= "
                </tr>";
        }
        return $data;
    }
    //
}
