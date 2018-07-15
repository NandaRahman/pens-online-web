<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = "program_studi";
    protected $fillable = [
        'nomor',
        'program',
        'jurusan',
        'kepala',
        'departemen',
        'kode_epsbed',
        'nomor_sk',
        'nomor_sk_inggris',
        'tanggal_sk',
        'gelar',
        'gelar_inggris',
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

    public function getKepala()
    {
        return $this->belongsTo(
            'App\Models\Pegawai',
            'kepala',
            'nomor'
        );
    }

    public function getDepartemen()
    {
        return $this->belongsTo(
            'App\Models\Departemen',
            'departemen',
            'nomor'
        );
    }
    //
}
