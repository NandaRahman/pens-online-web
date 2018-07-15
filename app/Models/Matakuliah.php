<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = "matakuliah";
    protected $fillable = [
        'nomor',
        'program',
        'jurusan',
        'kelas',
        'semester',
        'kode',
        'matakuliah',
        'jam',
        'sks',
        'mk_group',
        'mk_wajib',
        'tahun',
        'matakuliah_inggris',
        'matakuliah_singkatan',
        'tanggal_mulai_efektif',
        'tanggal_akhir_efektif',
        'matakuliah_jenis',
        'tanggal',
        'ip_pc',
        'host_pc',
        'user_pc',
    ];

    public function getKuliah()
    {
        return $this->hasMany(
            'App\Models\Kuliah',
            'matakuliah',
            'nomor'
        );

    }

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
            'jurusan',
            'nomor'
        );

    }
    //
}
