<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UploadFile extends Model
{
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function userFile()
    {
        return $this->belongsTo(UserFile::class, 'user_file_id');
    }

    public function userUpload()
    {
        return $this->belongsTo(UserUpload::class, 'user_upload_id');
    }
}
