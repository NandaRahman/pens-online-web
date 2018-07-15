<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table = "departemen";
    protected $fillable = [
        'nomor',
        'departemen',
        'kepala',
        'departemen_inggris',
    ];

    public function getDepartemen()
    {
        return $this->hasOne(
            'App\Models\Departemen',
            'departemen',
            'nomor'
        );
    }

}
