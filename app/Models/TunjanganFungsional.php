<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TunjanganFungsional extends Model
{
    protected $table = 'tunjangan_fungsional';

    protected $fillable = [
        'jabatan_fungsional',
        'tunjangan',
    ];

    public $timestamps = false;
}
