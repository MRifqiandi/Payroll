<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'employee_id',
        'tanggalKehadiran',
        'statusKehadiran',
        'waktuMasuk',
        'waktuKeluar',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
