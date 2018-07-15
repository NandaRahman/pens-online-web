<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = "jurusan";
    protected $fillable = [
        'nomor',
        'jurusan',
        'kejur',
        'sekjur',
        'alias',
        'jurusan_inggris',
        'jurusan_lengkap',
    ];

    public function getMatakuliah()
    {
        return $this->hasMany(
            'App\Models\Matakuliah',
            'jurusan',
            'nomor'
        );

    }

    public function getKelas()
    {
        return $this->hasMany(
            'App\Models\Kelas',
            'jurusan',
            'nomor'
        );

    }

    //
}
