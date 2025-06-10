<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TunjanganUmum extends Model
{
    use HasFactory;
    protected $table = 'tunjangan_umum';

    protected $fillable = [
        'golongan',
        'tunjangan',
    ];

    public $timestamps = false;
}
