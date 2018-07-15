<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = "program";
    protected $fillable = [
        'nomor',
        'program',
        'keterangan',
        'lama_studi',
        'gelar',
        'gelar_inggris',
        'program_ijazah',
        'program_ijazah_singkat',
    ];

    public function getMatakuliah()
    {
        return $this->hasMany(
            'App\Models\Matakuliah',
            'program',
            'nomor'
        );

    }


    public function getKelas()
    {
        return $this->hasMany(
            'App\Models\Kelas',
            'program',
            'nomor'
        );

    }


    //
}
