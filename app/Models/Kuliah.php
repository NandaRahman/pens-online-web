<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuliah extends Model
{
    protected $table = "kuliah";
    protected $fillable = [
        'nomor',
        'tahun',
        'semester',
        'kelas',
        'matakuliah',
        'hari',
        'jam',
        'ruang',
        'dosen',
        'asisten',
        'kehadiran',
        'tglujian',
        'ruangujian',
        'tglnilai',
        'ip_pc',
        'host_pc',
        'user_pc',
        'prosenq1',
        'prosenq2',
        'prosent',
        'prosenu',
        'kunci',
        'publik',
        'teknisi',
        'ruang_2',
        'hari_2',
        'jam_2',
    ];



    public function getKelas()
    {
        return $this->belongsTo(
            'App\Models\Kelas',
            'kelas',
            'nomor'
        );
    }

    public function getHari()
    {
        return $this->belongsTo(
            'App\Models\Hari',
            'hari',
            'nomor'
        );

    }

    public function getJam()
    {
        return $this->belongsTo(
            'App\Models\Jam',
            'jam',
            'nomor'
        );

    }

    public function getMatakuliah()
    {
        return $this->belongsTo(
            'App\Models\Matakuliah',
            'matakuliah',
            'nomor'
        );

    }

    public function getAbsen()
    {
        return $this->hasMany('App\Models\AbsensiMahasiswa',
            'kuliah','nomor'
        );
    }

    //
}
