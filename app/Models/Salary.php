<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $table = 'salary';

    protected $fillable = [
        'employee_id',
        'periode_gaji',
        'gaji_pokok',
        'tunjangan_umum',
        'tunjangan_fungsional',
        'tunjangan_kinerja',
        'tunjangan_lain_lain',
        'tunjangan_pembulatan',
        'tunjangan_beras',
        'tunjangan_istri_suami',
        'tunjangan_anak',
        'uang_makan',
        'uang_lembur',
        'gaji_kotor',
        'potongan_pph21',
        'potongan_bpjs',
        'potongan_iwp_8',
        'potongan_iwp_1',
        'potongan_lain',
        'total_potongan',
        'gaji_bersih',
    ];

    public $timestamps = true;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
