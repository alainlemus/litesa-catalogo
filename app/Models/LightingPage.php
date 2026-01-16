<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LightingPage extends Model
{
    protected $fillable =[
        'section1_title',
        'section1_description',
        'section1_items',
        'section1_image_path',
        'section2_title',
        'section2_description',
        'section2_image_path',
        'section2_url',
        'section3_images',
        'title',
        'description',
        'meta_description',
        'og_title',
        'og_description',
        'og_image_path',
        'header_image'
    ];

    protected $casts = [
        'section1_items' => 'array',
        'section3_images' => 'array',
    ];
}
