<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bpjs extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'bpjs';

    // Tentukan kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'employee_id',
        'salary_id',
        'jenisBpjs',
        'iuranPerusahaan',
        'iuranKaryawan',
        'tanggalIuran',
    ];

    // Relasi dengan model Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // Total Iuran (tidak perlu diisi, otomatis dihitung oleh MySQL)
    protected $casts = [
        'totalIuran' => 'decimal:2',
    ];
}
