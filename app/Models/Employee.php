<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasFactory;
    use HasRoles;

    protected $table = 'employee';

    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'tanggalLahir',
        'statusPernikahan',
        'jabatan',
        'ptkp_id',
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

    protected $casts = [
    'tanggalLahir' => 'date',
    'tanggalMasuk' => 'date',
    'tanggalKeluar' => 'date',
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

    public function laporans()
{
    return $this->hasMany(Laporan::class);
}


}
