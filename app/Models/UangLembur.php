<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UangLembur extends Model
{
    protected $table = 'uang_lembur';

    protected $fillable = [
        'golongan',
        'nominal',
        'satuan',
    ];

    public $timestamps = false;
}
