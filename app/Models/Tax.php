<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'tax';

    // Tentukan kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'employee_id',
        'ptkp_id',
        'pph21',
        'penghasilan_neto',
        'penghasilan_kena_pajak',
        'tahun',
        'bulan',
        'tanggalLaporan'
    ];

    // Relasi dengan model Employee
public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function salary()
    {
        return $this->hasOne(Salary::class, 'employee_id', 'employee_id')
            ->whereYear('periodeGaji', $this->tahun)
            ->whereMonth('periodeGaji', $this->bulan);
    }

    public function ptkp()
    {
        return $this->belongsTo(Ptkp::class, 'ptkp_id');
    }

}
