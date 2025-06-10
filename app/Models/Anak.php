<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'anak';

    protected $fillable = [
        'employee_id',
        'nama',
        'tanggal_lahir',
        'sudah_kawin',
        'punya_penghasilan',
        'menjadi_tanggungan',
    ];

    protected $casts = [
        'sudah_kawin' => 'boolean',
        'punya_penghasilan' => 'boolean',
        'menjadi_tanggungan' => 'boolean',
        'tanggal_lahir' => 'date',
    ];

    // Relasi ke Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
