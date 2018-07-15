<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginPegawai extends Model
{
    protected $table = "login_pegawai";
    protected $fillable = ['nomor','email','password', 'tanggal'];

    public function getIndentity()
    {
        return $this->belongsTo(
            'App\Models\Pegawai',
            'nomor',
            'nomor'
        );
    }
    //
}
