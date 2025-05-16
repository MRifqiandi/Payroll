<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalaryRaise extends Model
{
    use HasFactory;

    protected $table = 'salary_raise';

    protected $fillable = [
        'employee_id',
        'gajiLama',
        'gajiBaru',
        'persentaseKenaikan',
        'alasan',
        'tanggalKenaikan',
    ];

    // Relasi ke model Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
