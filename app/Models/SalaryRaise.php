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

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    // Hitung status perubahan
    public function getStatusAttribute()
    {
        if (is_null($this->gajiLama) || is_null($this->gajiBaru)) return 'Tidak diketahui';

        if ($this->gajiBaru > $this->gajiLama) return 'Naik';
        if ($this->gajiBaru < $this->gajiLama) return 'Turun';
        return 'Tetap';
    }

    public function getSelisihAttribute()
    {
        if (is_null($this->gajiLama) || is_null($this->gajiBaru)) return null;

        return $this->gajiBaru - $this->gajiLama;
    }
}
