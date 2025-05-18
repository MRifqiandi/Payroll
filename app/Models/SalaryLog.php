<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryLog extends Model
{
    use HasFactory;
    
    protected $table = 'salary_log';

    protected $fillable = [
        'salary_id',
        'employee_id',
        'field',
        'old_value',
        'new_value',
        'alasan',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class);
    }
}
