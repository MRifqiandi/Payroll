<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasJabatan extends Model
{
    protected $table = 'kelas_jabatan';

    protected $fillable = [
        'nama_jabatan',
        'kelas_jabatan',
    ];

    public $timestamps = false;

    public function tunjanganKinerja()
    {
        return $this->hasOne(TunjanganKinerja::class, 'kelas_jabatan_id');
    }
}
