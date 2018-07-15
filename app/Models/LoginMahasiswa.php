<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginMahasiswa extends Model
{
    protected $table = "login_mahasiswa";
    protected $fillable = ['nomor','email','password', 'tanggal'];
    protected $dates = [];

    public function getIdentity()
    {
        return $this->belongsTo(
            'App\Models\Mahasiswa',
            'nomor',
            'nomor'
        );
    }

}
