<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;


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
        'golongan',
        'jabatan_fungsional_id',
    ];

    // Casting tipe data kolom
    protected $casts = [
        'tanggalLahir' => 'date',
        'tanggalMasuk' => 'date',
        'tanggalKeluar' => 'date',
        'masaKerja' => 'integer',
        'ptkp_id' => 'integer',
    ];


    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
    public function tax()
    {
        return $this->hasOne(Tax::class);
    }
    public function ptkp()
{
    return $this->belongsTo(Ptkp::class, 'ptkp_id');
}



public function user()
{
    return $this->hasOne(User::class);
}


    public function bpjs()
    {
        return $this->hasMany(related: Bpjs::class);
    }

    // di model Employee
public function jabatanFungsional()
{
    return $this->belongsTo(JabatanFungsional::class, 'jabatan_fungsional_id');
}


    public function laporans()
{
    return $this->hasMany(Laporan::class);
}

public function anak()
{
    return $this->hasMany(Anak::class, 'employee_id', 'id');
}



public function getMasaKerjaGolonganAttribute()
{
    if (!$this->tanggal_naik_golongan_terakhir) return null;

    $start = Carbon::parse($this->tanggal_naik_golongan_terakhir);
    $now = Carbon::now();

    $tahun = $start->diffInYears($now);
    $bulan = $start->diffInMonths($now) % 12;

    return "$tahun tahun $bulan bulan";
}

public function salaryRaise()
{
    return $this->hasMany(SalaryRaise::class, 'employee_id');
}

public function getPrediksiNaikGajiAttribute()
{
    if (!$this->tanggal_naik_golongan_terakhir) return null;

    // Asumsi kenaikan berkala tiap 2 tahun
    $nextNaik = Carbon::parse($this->tanggal_naik_golongan_terakhir)->addYears(2);

    return $nextNaik->isPast()
        ? "Seharusnya sudah naik"
        : $nextNaik->translatedFormat('d F Y');
}


}
