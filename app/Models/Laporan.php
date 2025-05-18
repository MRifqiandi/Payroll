<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'employee_id',
        'jenisLaporan',
        'tanggalLaporan',
        'detailLaporan'
    ];

    protected $casts = [
        'detailLaporan' => 'array',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
