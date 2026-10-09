<?php

namespace App\Models;

use App\Support\ContentDefaults;
use Illuminate\Database\Eloquent\Model;

class ServicesPageSetting extends Model
{
    protected $fillable = [
        'hero_title', 'hero_subtitle', 'values', 'steps', 'sectors', 'reasons',
        'cta_title', 'cta_text', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'values' => 'array',
        'steps' => 'array',
        'sectors' => 'array',
        'reasons' => 'array',
    ];

    /** Registro único; se crea con el contenido por defecto la primera vez. */
    public static function current(): self
    {
        return static::first() ?? static::create(ContentDefaults::servicesPage());
    }
}
