<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ter extends Model
{
    use HasFactory;

    protected $table = 'ter';

    // Jika kamu pakai timestamp default (created_at, updated_at)
    public $timestamps = true;

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'ptkp_id',
        'kategori_ter',
        'range_penghasilan_dari',
        'range_penghasilan_sampai',
        'tarif_ter',
    ];

    /**
     * Relasi Ter ke Ptkp
     */
    public function ptkp()
    {
        return $this->belongsTo(Ptkp::class, 'ptkp_id');
    }
}
