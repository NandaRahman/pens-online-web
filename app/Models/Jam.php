<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    protected $table = "jam";
    protected $fillable = [
        'nomor',
        'program',
        'hari',
        'kode',
        'jam',
        'sore',
    ];

    public function getKuliah()
    {
        return $this->hasMany(
            'App\Models\Kuliah',
            'jam',
            'nomor'
        );
    }

    //
}
