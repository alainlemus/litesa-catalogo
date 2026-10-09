<?php

namespace App\Support;

use Illuminate\Support\Str;

class Seo
{
    /** Título con marca, sin pasar de 60 caracteres (se acorta en límite de palabra). */
    public static function title(string $title, string $suffix = ' | Grupo Litesa'): string
    {
        $title = trim(preg_replace('/\s+/', ' ', $title));

        if (mb_strlen($title . $suffix) <= 60) {
            return $title . $suffix;
        }

        if (mb_strlen($title) <= 60) {
            return $title;
        }

        return rtrim(Str::of($title)->limit(59, '', preserveWords: true)->toString(), " ,:;-–|") . '…';
    }
}
