<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    public const CACHE_KEY = 'site_setting.current';

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

    /**
     * Configuración del sitio en caché (se consulta en cada request desde el layout).
     */
    public static function current(): ?self
    {
        return Cache::remember(self::CACHE_KEY, now()->addHour(), fn () => static::first());
    }

    protected static function booted(): void
    {
        $forget = fn () => Cache::forget(self::CACHE_KEY);

        static::saved($forget);
        static::deleted($forget);
    }
}
