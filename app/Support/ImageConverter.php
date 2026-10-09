<?php

namespace App\Support;

class ImageConverter
{
    /** Extensiones que se convierten a WebP (SVG, GIF y WebP se dejan igual). */
    public const CONVERTIBLE = ['jpg', 'jpeg', 'png'];

    /**
     * Convierte un archivo de imagen a WebP y devuelve los bytes resultantes.
     */
    public static function webpBytes(string $sourcePath, int $maxWidth = 2000, int $quality = 82): ?string
    {
        $data = @file_get_contents($sourcePath);
        if ($data === false) {
            return null;
        }

        $image = @imagecreatefromstring($data);
        if (! $image) {
            return null;
        }

        // Corrige la orientación EXIF de las fotos de celular
        if (function_exists('exif_read_data') && preg_match('/\.jpe?g$/i', $sourcePath)) {
            $exif = @exif_read_data($sourcePath);
            $rotation = match ($exif['Orientation'] ?? 1) {
                3 => 180, 6 => -90, 8 => 90, default => 0,
            };
            if ($rotation && ($rotated = imagerotate($image, $rotation, 0))) {
                $image = $rotated;
            }
        }

        if (imagesx($image) > $maxWidth) {
            $image = imagescale($image, $maxWidth, -1, IMG_BICUBIC) ?: $image;
        }

        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);

        ob_start();
        imagewebp($image, null, $quality);
        $bytes = ob_get_clean();
        imagedestroy($image);

        return $bytes ?: null;
    }

    public static function isConvertible(string $pathOrName): bool
    {
        return in_array(strtolower(pathinfo($pathOrName, PATHINFO_EXTENSION)), self::CONVERTIBLE, true);
    }
}
