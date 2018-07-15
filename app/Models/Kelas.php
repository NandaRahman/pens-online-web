<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "kelas";
    protected $fillable = [
        'nomor',
        'konsentrasi',
        'wali_kelas',
        'program',
        'jurusan',
        'kelas',
        'pararel',
        'kode',
        'kode_kelas_absen'.
        'kode_epsbed'
    ];

    public function getProgram()
    {
        return $this->belongsTo(
            'App\Models\Program',
            'program',
            'nomor'
            );
    }

    public function getJurusan()
    {
        return $this->belongsTo(
            'App\Models\Jurusan',
            'program',
            'nomor'
            );
    }

    public function getKuliah()
    {
        return $this->hasMany(
            'App\Models\Kuliah',
            'kelas',
            'nomor'
        );
    }

    public function getWaliKelas()
    {
        return $this->belongsTo(
            'App\Models\Pegawai',
            'wali_kelas',
            'nomor'
        );
    }
}
