<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hari extends Model
{
    protected $table = "hari";
    protected $fillable = [
        'nomor',
        'hari',
    ];

    public function getKuliah()
    {
        return $this->hasMany(
            'App\Models\Kuliah',
            'hari',
            'nomor'
        );
    }

}
