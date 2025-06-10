<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanFungsional extends Model
{
    use HasFactory;

    protected $table = 'jabatan_fungsional';

    protected $primaryKey = 'id'; // biasanya default 'id', sesuaikan jika beda

    protected $fillable = [
        'nama_jabatan_fungsional',
        'keterangan',
    ];

    /**
     * Relasi ke tunjangan kinerja dosen (tukin)
     */
    public function tunjanganKinerjaDosens()
    {
        return $this->hasMany(TunjanganKinerjaDosen::class, 'jabatan_fungsional_id');
    }

    public function tunjanganFungsionalDosen(): HasMany
    {
        return $this->hasMany(TunjanganFungsionalDosen::class, 'jabatan_fungsional_id');
    }
}
