<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    const STATE_LECTURER = 0;
    const STATE_STUDENT = 1;

    protected $primaryKey="nomor";

    public $timestamps = false;



    protected $table = "reminder";

    protected $fillable = [
        'nomor',
        'unik_tipe',
        'untuk',
        'pengguna',
        'judul',
        'pesan',
        'tanggal_buat',
        'tanggal_kirim',
        'status',
    ];

    public function getPengguna()
    {
        if ($this->untuk == self::STATE_STUDENT){
            return $this->belongsTo(
                'App\Models\Mahasiswa',
                'pengguna',
                'nomor'
            );
        }else if ($this->untuk == self::STATE_LECTURER){
            return $this->belongsTo(
                'App\Models\Pegawai',
                'pengguna',
                'nomor'
            );
        }
    }


    //
}
