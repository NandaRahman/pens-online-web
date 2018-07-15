<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = "pegawai";
    protected $fillable = [
        'nomor',
        'nama',
        'staff',
        'no_telp'
    ];

    public function getAkun()
    {
        return $this->hasOne(
            'App\Models\LoginPegawai',
            'nomor',
            'nomor'
        );
    }

    public function getStaff()
    {
        return $this->belongsTo(
            'App\Models\Staff',
            'staff',
            'nomor'
        );
    }

    public function getAbsensi()
    {
        return $this->hasMany(
            'App\Models\Absensikaryawan',
            'pegawai',
            'nomor'
        );
    }

    public function getKuliah()
    {
        return $this->hasMany(
            'App\Models\Kuliah',
            'dosen',
            'nomor'
        );
    }

    //
}
