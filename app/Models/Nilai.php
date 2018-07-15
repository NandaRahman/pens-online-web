<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = "nilai";
    protected $fillable = [
        'nomor',
        'kuliah',
        'mahasiswa',
        'quis1',
        'quis2',
        'tugas',
        'ujian',
        'her',
        'na',
        'nh',
        'keterangan',
        'nhu',
        'nsp',
    ];

    public function getKuliah()
    {
        return $this->belongsTo('App\Models\Kuliah',
            'kuliah','nomor'
        );
    }

    public function getMahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa',
            'mahasiswa', 'nomor');
    }

    public function getAccess(){
        $relation = $this->belongsTo('App\Models\Kuliah', 'kuliah','nomor')->get();
        if ($relation->publik == 1) {
            return true;
        }else{
            return false;
        }
    }

    //
}
