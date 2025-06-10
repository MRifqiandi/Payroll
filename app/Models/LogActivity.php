<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogActivity extends Model
{
    use HasFactory;

    protected $table = 'log_activity';

    protected $fillable = [
        'users_id',
        'action',
        'level',
        'description',
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}
