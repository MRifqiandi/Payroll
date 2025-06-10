<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiPokokPns extends Model
{
    use HasFactory;
    // Nama tabel
    protected $table = 'gaji_pokok_pns';

    // Primary key
    protected $primaryKey = 'id';

    public $timestamps = true;

    // Field yang boleh diisi secara mass assignment
    protected $fillable = [
        'golongan',
        'mkg',
        'nominal',
    ];

    // Jika ingin mengatur format tipe data, bisa pakai casting
    protected $casts = [
        'mkg' => 'integer',
        'nominal' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
