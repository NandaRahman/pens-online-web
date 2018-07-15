<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensikaryawan extends Model
{
    protected $table = "absensikaryawan";
    protected $fillable = [
        'pegawai',
        'tanggal',
        'masuk',
        'pulang',
        'pulangawal',
        'terlambat1',
        'terlambat2',
        'tidakabsen',
        'tidakmasuk',
        'libur',
        'lembur',
    ];

    public function getPegawai()
    {
        return $this->belongsTo(
            'App\Models\Pegawai',
            'pegawai',
            'nomor'
        );
    }

}
