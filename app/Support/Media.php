<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class Media
{
    /**
     * URL absoluta de un archivo subido (disco público en local, S3 en producción).
     */
    public static function url(?string $path, ?string $fallback = null): ?string
    {
        if (blank($path)) {
            return $fallback;
        }

        $path = ltrim($path, '/');

        // Producción usa S3; en local (o sin bucket configurado) se sirve desde el disco público
        $useS3 = ! app()->environment('local') && filled(config('filesystems.disks.s3.bucket'));

        return $useS3
            ? Storage::disk('s3')->url($path)
            : asset('storage/' . $path);
    }
}
