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
        'salary_id',
        'pph21',
    ];

    // Relasi dengan model Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
