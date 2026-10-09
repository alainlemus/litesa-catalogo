<?php

namespace App\Providers;

use App\Models\SiteSetting;
use App\Support\ImageConverter;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Toda imagen JPG/PNG subida desde el panel se guarda como WebP (máx. 2000px)
        FileUpload::configureUsing(function (FileUpload $component): void {
            $component->saveUploadedFileUsing(function (TemporaryUploadedFile $file) use ($component) {
                $disk = $component->getDiskName();
                $directory = $component->getDirectory();
                $visibility = $component->getVisibility();

                // El favicon se deja en su formato original (compatibilidad con navegadores)
                if ($component->getName() !== 'favicon' && ImageConverter::isConvertible($file->getClientOriginalName())) {
                    $bytes = ImageConverter::webpBytes($file->getRealPath());

                    if ($bytes !== null) {
                        $name = Str::ulid() . '.webp';
                        $path = trim(($directory ? $directory . '/' : '') . $name, '/');
                        \Illuminate\Support\Facades\Storage::disk($disk)->put($path, $bytes, $visibility);

                        return $path;
                    }
                }

                return $file->storePubliclyAs($directory, $component->getUploadedFileNameForStorage($file), $disk);
            });
        }, isImportant: true); // importante: se aplica después del setUp() del componente

        View::composer(['layouts.*', 'livewire.*'], function ($view) {
            $view->with('site', SiteSetting::current());
        });
    }
}
