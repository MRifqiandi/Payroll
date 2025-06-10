<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ptkp extends Model
{

    use HasFactory;
    // Nama tabel
    protected $table = 'ptkp';

    // Primary key (default 'id', ini bisa dihilangkan jika tetap 'id')
    protected $primaryKey = 'id';

    // Mass assignable fields
    protected $fillable = [
        'kode_ptkp',
        'nilai_ptkp',
    ];

    // Jika kamu ingin Laravel otomatis mengelola timestamps created_at dan updated_at
    public $timestamps = true;

    public function taxes()
    {
        return $this->hasMany(Tax::class, 'ptkp_id');
    }


}
