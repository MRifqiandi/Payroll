<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salary';
    protected $fillable = [
        'employee_id', 'periodeGaji', 'gajiPokok', 'tunjanganTransportasi', 'tunjanganMakan',
        'tunjanganKesehatan', 'bonus', 'insentif', 'lembur', 'totalPotongan', 'totalGaji'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function tax()
{
    return $this->hasOne(Tax::class, 'employee_id', 'employee_id');
}

public function bpjs()
{
    return $this->hasOne(BPJS::class, 'employee_id', 'employee_id');
}

}
