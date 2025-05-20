<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{

    use HasFactory;
    protected $table = 'laporan';

    protected $fillable = [
        'employee_id',
        'jenisLaporan',
        'tanggalLaporan',
        'detailLaporan',
        'originalBuktiPotong',
        'originalFileLaporan'
    ];

    protected $casts = [
        'detailLaporan' => 'array',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
