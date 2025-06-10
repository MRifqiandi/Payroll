<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TunjanganFungsionalDosen extends Model
{
    use HasFactory;
    // Nama tabel (jika tidak sesuai dengan plural model)
    protected $table = 'tunjangan_fungsional_dosen';

    // Field yang boleh diisi mass assignment
    protected $fillable = [
        'jabatan_fungsional_id',
        'nominal',
    ];

    // Jika tidak ada kolom created_at dan updated_at
    public $timestamps = false;

    /**
     * Relasi ke JabatanFungsional (asumsi Anda punya model JabatanFungsional)
     *
     * @return BelongsTo
     */
    public function jabatanFungsional(): BelongsTo
    {
        return $this->belongsTo(JabatanFungsional::class, 'jabatan_fungsional_id');
    }
}
