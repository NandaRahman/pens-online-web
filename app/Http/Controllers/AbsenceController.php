<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Pelajaran;
use App\Models\Siswa;
use App\Models\StatusAbsensi;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsenceController extends Controller
{
    //
    public $check_active, $get_guru, $user, $check_status, $get_absence;
    public function __construct(){
        $this->middleware('auth');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function init(){
        $user = Auth::user();
        $this->user = $user;
        $this->get_guru = Guru::all()->where('id_user','=', $this->user->id)->first();
        $this->check_status = StatusAbsensi::all()->where('tanggal','=',date('Y-m-d'))->first();
    }

    function call(){
        $this->check_active = $this->getActiveAbsence();
        $this->check_open = $this->checkAbsenceStatus();
        $this->get_avail_absence = $this->getAvailableAbsence();
        $this->get_done_absence = $this->getFinishedAbsence();
    }

    public function index(){
        $this->init();
        $this->call();
        if ($this->check_active === false){
            return redirect()->route('user.report');
        }
        return view('user/absence')->with('data', $this->check_active);
    }

    public function checkAbsenceStatus(){
        $this->init();
        if(sizeof($this->check_status) != 0){
            $absen = DB::table('jadwal as jd')
                ->join('jam as jm','jd.jam','=', 'jm.id')
                ->where('jd.id_guru','=',$this->get_guru->id)
                ->where('jd.hari','=',date('N'))
                ->whereRaw("jm.jam <= "."'".date('H:i:s')."'")
                ->whereRaw("DATE_ADD(jm.jam, INTERVAL 1 HOUR) >= "."'".date('H:i:s')."'")
                ->select('jd.*', 'jm.jam')
                ->first();
            if (sizeof($absen) != 0){
                return $absen;
            }
        }
        return false;
    }

    public function getAvailableAbsence(){
        $this->init();
        if(sizeof($this->check_status) != 0){
            $absen = DB::table('jadwal as jd')
                ->join('jam as jm','jd.jam','=', 'jm.id')
                ->join('pelajaran as pe','jd.id_pelajaran','=', 'pe.id')
                ->join('kelas as ke','jd.id_kelas','=', 'ke.id')
                ->where('jd.id_guru','=',$this->get_guru->id)
                ->where('jd.hari','=',date('N'))
                ->select('jd.*', 'jm.jam')
                ->orderBy('jm.jam')
                ->selectRaw('jd.*,jm.jam, ke.kode_kelas, pe.nama as pelajaran, 1 as avail')
                ->get();
            if (sizeof($absen) != 0){
                return $absen;
            }
        }
        return false;
    }

    public function getFinishedAbsence(){
        $this->init();
        if(sizeof($this->check_status) != 0){
            $absen = DB::table('jadwal as jd')
                ->join('jam as jm','jd.jam','=', 'jm.id')
                ->join('absen as ab','ab.id_jadwal','=','jd.id')
                ->where('jd.id_guru','=',$this->get_guru->id)
                ->where('jd.hari','=',date('N'))
                ->select('jd.*', 'jm.jam')
                ->orderBy('jm.jam')
                ->groupBy('jd.id')
                ->get();
            if (sizeof($absen) != 0){
                return $absen;
            }
            return false;
        }
    }

    public function setDetailedAbsence(){
        $this->init();
        $this->call();
        $avail = $this->getAvailableAbsence();
        $done = $this->getFinishedAbsence();
        if ($avail) {
            for ($i = 0; sizeof($avail) > $i; $i++) {
                if ($done) {
                    foreach ($done as $val) {
                        if ($avail[$i]->id == $val->id) {
                            $avail[$i]->avail = 0;
                        }
                    }
                }
            }
            return $avail;
        }else{
            return false;
        }
    }


    public function getActiveAbsence(){
        $this->init();
        $absen = DB::table('absen as a')
            ->join('jadwal as j','a.id_jadwal','=','j.id')
            ->join('siswa as s','a.id_siswa','=','s.id')
            ->where('j.id_guru','=',$this->get_guru->id)
            ->whereRaw('DATE_FORMAT(a.absen_buka, "%H:%i:%s")<='."'".date('H:i:s')."'")
            ->whereRaw('DATE_FORMAT(a.absen_tutup, "%H:%i:%s")>='."'".date('H:i:s')."'")
            ->whereRaw('DATE_FORMAT(a.absen_buka, "%Y-%m-%d")='."'".date('Y-m-d')."'")
            ->select('a.*', 'j.id_guru','j.id_kelas','s.nama')
            ->get();
        if (sizeof($absen) > 0){
            return $absen;
        }else{
            return false;
        }
    }

    public function updateStatusAbsence(Request $request){
        $this->init();
        $this->call();
        DB::table('absen')->where([
            'id'=>$request->id,
        ])->update(['status' => $request->detail]);
        echo "success";
    }

    public function openAbsence(Request $request){
        $this->init();
        $this->call();
        if ($this->check_status){
            if ($this->check_active === false){
                $jadwal = Jadwal::all()->where('id','=',$request->id)->first();
                $siswa = Siswa::all()->where('id_kelas','=',$jadwal->id_kelas);
                $pelajaran = Pelajaran::all()->where('id','=',$jadwal->id_pelajaran)->first();
                $interval = $pelajaran->jam * 45;
                $date_start = new DateTime();
                $date_end = new DateTime();
                $date_end->modify("+$interval minute");
                foreach ($siswa as $val){
                    Absen::create([
                        'id_siswa'=>$val->id,
                        'id_jadwal'=>$jadwal->id,
                        'status'=>'A',
                        'absen_buka'=>$date_start,
                        'absen_tutup'=>$date_end
                    ]);
                }
            }
        }
        return redirect()->route('user.absence');
    }

    public function closeAbsence(){
        $this->init();
        $this->call();
        if (isset($this->check_active[0]->id_jadwal))
        DB::table('absen')->where([
            'id_jadwal'=>$this->check_active[0]->id_jadwal,
        ])->update(['absen_tutup' => date('Y-m-d H:i:s')]);;
        return redirect()->route('home');
    }




}
