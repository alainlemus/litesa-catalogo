<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'image',
        'excerpt',
        'content',
        'status',
    ];

    // Generar el slug automáticamente
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            if (! $post->slug) {
                $post->slug = Str::slug($post->title);
            }
        });
    }
}
