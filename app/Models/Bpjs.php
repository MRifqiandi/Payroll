<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bpjs extends Model
{
    use HasFactory;

    protected $table = 'bpjs';

    protected $fillable = [
        'employee_id',
        'periode',
        'iuran_total',
        'iuran_perusahaan',
        'iuran_peserta',
    ];

    /**
     * Relasi ke model Employee
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
