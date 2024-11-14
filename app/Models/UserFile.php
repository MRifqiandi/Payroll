<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UserFile extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $table;
    public $incrementing = false;
    protected $keyType = 'uuid';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('database.tables.DB_USER_FILES');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function upload()
    {
        return $this->belongsTo(UserUpload::class, 'user_upload_id', 'id');
    }
}
