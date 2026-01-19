<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'title',
        'description',
        'favicon',
        'logo_light',
        'logo_dark',
        'share_title',
        'share_description',
        'share_image',
        'socials',
        'primary_color',
        'secondary_color',
        'tertiary_color',
        'privacy_policy',
        'contact_phone',
        'contact_email',
        'contact_address',
        'contact_hours',
        'whatsapp',
    ];

    protected $casts = [
        'socials' => 'array',
    ];
}
