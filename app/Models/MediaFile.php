<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaFile extends Model
{
    protected $fillable = [
        'name',
        'path',
        'extension',
        'uploaded_by',
    ];
}
