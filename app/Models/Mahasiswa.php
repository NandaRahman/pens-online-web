<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = "mahasiswa";
    protected $fillable = ['nomor','nrp','nama','kelas','status', 'no_telp'];

    public function getAkun()
    {
        return $this->hasOne(
            'App\Models\LoginMahasiswa',
            'nomor',
            'nomor'
        );
    }

    public function getKelas()
    {
        return $this->belongsTo('App\Models\Kelas',
            'kelas','nomor'
        );
    }

    public function getNilai()
    {
        return $this->hasMany('App\Models\Nilai',
            'mahasiswa','nomor');
    }

    public function getAbsensi($options = [])
    {
        $relation =  $this->hasMany('App\Models\AbsensiMahasiswa',
            'mahasiswa','nomor');
        if (!empty($options['semester'])) {
            $relation = $relation->where('semester','=',$options['semester']);
        }
        if (!empty($options['kuliah'])) {
            $relation = $relation->where('kuliah','=',$options['kuliah']);
        }
        $data = $relation->get();
        $result = $this->setAbsence($data);
        usort($result, function($a, $b) {
            $day =  $a['hari_id'] - $b['hari_id'];
            if($day) return $day;
            return $a['jam'] - $b['jam'];
        });
        return $result;
    }

    //Function Get Student Absence
    private function setAbsence($data){
        $result = $queue = $array = [];
        $temp = $alpha = $meets = 0;
        foreach($data as $val){
            if($temp != $val->nomor){
                $array = $array + ["nomor" => $val->nomor];
                $array = $array + ["minggu" => []];
                $temp = $val->nomor;
            }
            //Condition For Adding Queue
            if($val->status == "A"){
                $alpha++;
            }
            if($val->pengganti == 1){//Got some error here
                $queue = $queue + ["week".$val->minggu => $val->status];
            }else{
                $array["minggu"] = $array["minggu"] + ["week".$val->minggu => $val->status];
            }
            $meets++;
        }
        $array = $this->setAbsenceReplace($queue, $array);
        $array = $array + ["alpha" => $alpha];
        $array = $array + ["pertemuan" => $meets];
        $result[] = $array;
        return $result;
    }

    private function setAbsenceReplace($queue, $array){
        for ($i = 1; $i <= 16; $i++) {
            if (!isset($array['minggu']["week".$i])) {
                if (sizeof($queue) != 0) {
                    $var = array_shift($queue);
                    $array['minggu']["week".$i] = $var;
                } else {
                    $array['minggu']["week".$i] = "-";
                }
            }
        }
        $array['total_pertemuan']=16;
        $array['total_pertemuan']=16;
        return $array;
    }

}
