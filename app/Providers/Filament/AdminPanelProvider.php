<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProductUseResource;
use App\Filament\Resources\ColorTemperatureResource;
use App\Filament\Resources\ProductVariantResource;
use App\Filament\Resources\ProductPhotoResource;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class AdminPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        $setting = SiteSetting::first();

        $faviconUrl = (App::environment('local') ? asset('storage/' . ltrim($setting->favicon, '/')) : Storage::disk('s3')->url($setting->favicon));

        $logoUrl = (App::environment('local') ? asset('storage/' . ltrim($setting->logo_light, '/')) : Storage::disk('s3')->url($setting->logo_light));

        return $panel
            ->default()
            ->breadcrumbs(false)
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Grupo Litesa')
            ->favicon($faviconUrl)
            ->brandLogo($logoUrl)
            ->brandLogoHeight('42px')
            ->darkMode(false)
            ->resources([
                ProductResource::class,
                ProductUseResource::class,
                ColorTemperatureResource::class,
                ProductVariantResource::class,
                ProductPhotoResource::class,
            ])
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
