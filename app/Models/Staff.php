<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = "staff";
    protected $fillable = [
        'nomor',
        'staff',
    ];

    public function getPegawai()
    {
        return $this->hasMany(
            'App\Models\Pegawai',
            'staff',
            'nomor'
        );
    }

    //
}
