<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GajiPokokPppk extends Model
{
    use HasFactory;

    protected $table = 'gaji_pokok_pppk';

    protected $fillable = [
        'golongan',
        'mkg',
        'nominal',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'mkg' => 'integer',
    ];

    public $timestamps = true;
}
