<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TunjanganKinerja extends Model
{
    protected $table = 'tunjangan_kinerja';

    protected $fillable = [
        'kelas_jabatan_id',
        'tunjangan',
    ];

    public $timestamps = false;

    public function kelasJabatan()
    {
        return $this->belongsTo(KelasJabatan::class, 'kelas_jabatan_id');
    }
}
