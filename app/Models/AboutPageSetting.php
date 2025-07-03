<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPageSetting extends Model
{
    protected $fillable = [
        'hero_image',
        'hero_text',
        'section1_text',
        'section1_image',
        'section2_text',
        'section2_image',
        'section3_text',
        'about_title',
        'about_description',
        'about_svg',
        'mission_title',
        'mission_description',
        'mission_svg',
        'vision_title',
        'vision_description',
        'vision_svg',
        'services',
        'testimonials_title',
        'testimonials_description',
    ];

    protected $casts = [
        'services' => 'array',
    ];
}
