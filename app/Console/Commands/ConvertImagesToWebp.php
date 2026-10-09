<?php

namespace App\Console\Commands;

use App\Support\ImageConverter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ConvertImagesToWebp extends Command
{
    protected $signature = 'images:webp {--disk=public} {--max=2000} {--quality=82} {--keep : No respalda ni elimina los originales} {--dry-run}';

    protected $description = 'Convierte las imágenes subidas (jpg/png) a WebP y actualiza las rutas en la base de datos';

    /** Columnas de la BD que guardan rutas de imágenes. */
    private const COLUMNS = [
        'posts' => ['image'],
        'about_page_settings' => ['hero_image', 'section1_image', 'section2_image'],
        'media_files' => ['path'],
        'product_photos' => ['path'],
        'product_uses' => ['image'],
        'testimonials' => ['image'],
        'site_settings' => ['logo_light', 'logo_dark', 'share_image'],
        'lighting_pages' => ['header_image', 'section1_image_path', 'section2_image_path', 'section3_images', 'og_image_path'],
    ];

    /** Se dejan como están por compatibilidad (favicon / apple-touch-icon requieren PNG). */
    private const SKIP = ['site/favicon', 'favicon.png', 'litesa-logo.png'];

    public function handle(): int
    {
        $disk = Storage::disk($this->option('disk'));
        $skipFav = optional(DB::table('site_settings')->first())->favicon;
        $dry = $this->option('dry-run');
        $map = [];
        $before = $after = 0;

        foreach ($disk->allFiles() as $path) {
            if (! ImageConverter::isConvertible($path) || $path === $skipFav || in_array(basename($path), self::SKIP, true)) {
                continue;
            }

            $new = preg_replace('/\.(jpe?g|png)$/i', '.webp', $path);
            $bytes = $dry ? null : ImageConverter::webpBytes($disk->path($path), (int) $this->option('max'), (int) $this->option('quality'));

            if (! $dry && $bytes === null) {
                $this->warn("No se pudo convertir: {$path}");
                continue;
            }

            $before += $disk->size($path);
            if (! $dry) {
                $after += strlen($bytes);
                $disk->put($new, $bytes);
                if (! $this->option('keep')) {
                    $backup = 'originals-backup/' . $path;
                    Storage::disk('local')->put($backup, $disk->get($path));
                    $disk->delete($path);
                }
            }
            $map[$path] = $new;
            $this->line("  {$path} → {$new}");
        }

        if (! $dry) {
            $this->updateDatabase($map);
            \Illuminate\Support\Facades\Cache::forget(\App\Models\SiteSetting::CACHE_KEY);
            \Illuminate\Support\Facades\Cache::forget('sitemap.xml');
        }

        $this->info(sprintf('%d imágenes. %.1f MB → %.1f MB', count($map), $before / 1048576, $after / 1048576));

        return self::SUCCESS;
    }

    private function updateDatabase(array $map): void
    {
        foreach (self::COLUMNS as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }
            foreach ($columns as $column) {
                if (! Schema::hasColumn($table, $column)) {
                    continue;
                }
                foreach (DB::table($table)->whereNotNull($column)->get(['id', $column]) as $row) {
                    $value = $row->{$column};
                    $decoded = json_decode($value, true);
                    $updated = is_array($decoded)
                        ? json_encode(array_map(fn ($p) => $map[$p] ?? $p, $decoded))
                        : ($map[$value] ?? $value);

                    if ($updated !== $value) {
                        DB::table($table)->where('id', $row->id)->update([$column => $updated]);
                    }
                }
            }
        }
    }
}
