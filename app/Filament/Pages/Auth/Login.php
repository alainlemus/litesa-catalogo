<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    protected static string $layout = 'filament.layouts.split';

    protected static string $view = 'filament.pages.auth.login';

    public function getHeading(): string | Htmlable
    {
        return 'Bienvenido de nuevo';
    }

    public function getSubHeading(): string | Htmlable | null
    {
        return 'Ingresa tus datos para administrar el sitio.';
    }

    public function hasLogo(): bool
    {
        return false;
    }
}
