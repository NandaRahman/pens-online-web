<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusAbsensi extends Model
{
    /**
     * No description found in the table comment.
     *
     * Class StatusAbsensi
     * @package App\Models
     *
     * @property integer $id
     * @property integer $tanggal
     * @property integer $status
     * @property \Carbon\Carbon $created_at
     * @property \Carbon\Carbon $updated_at
     */

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'status_absensi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tanggal', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['pivot'];


    /**
     * The attributes appended to the model's JSON form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];



}
