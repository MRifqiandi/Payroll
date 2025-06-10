<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UangMakan extends Model
{
    protected $table = 'uang_makan';

    protected $fillable = [
        'golongan',
        'nominal',
        'satuan',
    ];

    public $timestamps = false;
}
