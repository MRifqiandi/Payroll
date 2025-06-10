<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TunjanganKinerjaDosen extends Model
{
    use HasFactory;

    protected $table = 'tunjangan_kinerja_dosen';

    protected $primaryKey = 'id'; // sesuaikan jika beda

    protected $fillable = [
        'jabatan_fungsional_id',
        'kelas_jabatan',
        'nominal',
        'tahun_berlaku',
    ];

    /**
     * Relasi ke jabatan fungsional
     */
    public function jabatanFungsional()
    {
        return $this->belongsTo(JabatanFungsional::class, 'jabatan_fungsional_id');
    }
}
