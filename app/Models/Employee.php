<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';

    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'tanggalLahir',
        'statusPernikahan',
        'jabatan',
        'departemen',
        'statusKepegawaian',
        'masaKerja',
        'npwp',
        'email',
        'telepon',
        'tanggalMasuk',
        'tanggalKeluar',
    ];

    protected $dates = [
        'tanggalLahir',
        'tanggalMasuk',
        'tanggalKeluar',
        'created_at',
        'updated_at',
    ];

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
    public function tax()
    {
        return $this->hasOne(Tax::class);
    }

    public function bpjs()
    {
        return $this->hasMany(Bpjs::class);
    }

}
