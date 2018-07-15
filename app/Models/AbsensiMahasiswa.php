<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiMahasiswa extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;
    protected $table = "absensi_mahasiswa";
    protected $fillable = [
        'nomor',
        'kuliah',
        'mahasiswa',
        'minggu',
        'tanggal',
        'keterangan',
        'pengganti',
        'dosen',
        'hari_pengganti',
        'tanggal_entry',
        'telat',
        'server',
        'logout',
        'status'
    ];

    public function getMahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa',
            'mahasiswa','nomor'
        );
    }

    public function getKuliah()
    {
        return $this->belongsTo('App\Models\Kuliah', 'kuliah','nomor');
    }

    public function getDosen()
    {
        return $this->belongsTo('App\Models\Pegawai',
            'dosen','nomor'
        );
    }
    //
}
