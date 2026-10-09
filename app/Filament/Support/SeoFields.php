<?php

namespace App\Filament\Support;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class SeoFields
{
    /** Sección SEO reutilizable (título y descripción para buscadores). */
    public static function section(string $hint = 'Si lo dejas vacío se genera automáticamente.'): Section
    {
        return Section::make('SEO (buscadores y redes)')
            ->description($hint)
            ->icon('heroicon-o-magnifying-glass')
            ->collapsible()
            ->collapsed()
            ->schema([
                TextInput::make('meta_title')
                    ->label('Título SEO')
                    ->maxLength(60)
                    ->helperText('Ideal: hasta 60 caracteres.')
                    ->live(onBlur: true),
                Textarea::make('meta_description')
                    ->label('Descripción SEO')
                    ->rows(3)
                    ->maxLength(160)
                    ->helperText('Ideal: entre 120 y 160 caracteres.'),
            ]);
    }
}
