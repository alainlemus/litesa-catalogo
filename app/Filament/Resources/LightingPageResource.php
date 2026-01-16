<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LightingPageResource\Pages;
use App\Filament\Resources\LightingPageResource\RelationManagers;
use App\Models\LightingPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LightingPageResource extends Resource
{
    protected static ?string $model = LightingPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';
    protected static ?string $navigationLabel = 'Iluminación';
    protected static ?string $navigationGroup = 'Sitio Web';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Sección 1')
                ->schema([
                    Forms\Components\TextInput::make('section1_title')->label('Título'),
                    Forms\Components\Textarea::make('section1_description')->label('Descripción'),
                    Forms\Components\Repeater::make('section1_items')
                        ->label('Ítems con SVG')
                        ->schema([
                            Forms\Components\TextInput::make('text')->label('Texto'),
                            Forms\Components\Textarea::make('svg')->label('Código SVG'),
                        ])
                        ->default([])
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('header_image')
                        ->label('Imagen de encabezado')
                        ->directory('landing/header')
                        ->image()
                        ->preserveFilenames(),
                    Forms\Components\FileUpload::make('section1_image_path')
                        ->label('Imagen')
                        ->directory('landing/section1')
                        ->image()
                        ->preserveFilenames(),
                ])
                ->collapsible(),

                Forms\Components\Section::make('Sección 2')
                    ->schema([
                        Forms\Components\TextInput::make('section2_title')->label('Título'),
                        Forms\Components\Textarea::make('section2_description')->label('Descripción'),
                        Forms\Components\FileUpload::make('section2_image_path')
                            ->label('Imagen')
                            ->image()
                            ->disk('public')
                            ->directory('iluminacion')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml']),
                        Forms\Components\TextInput::make('section2_url')->label('URL del botón'),
                    ])
                    ->collapsible() // Permite colapsar manualmente
                    ->collapsed(),  // Inicia colapsada

                Forms\Components\Section::make('Sección 3')
                    ->schema([
                        Forms\Components\FileUpload::make('section3_images')
                            ->label('Galería de imágenes')
                            ->multiple()
                            ->label('Imagen')
                            ->image()
                            ->disk('public')
                            ->directory('iluminacion/logos')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'])
                            ->reorderable()
                            ->preserveFilenames(),
                    ])
                    ->collapsible() // Permite colapsar manualmente
                    ->collapsed(),  // Inicia colapsada,

                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('title')->label('Título SEO'),
                        Forms\Components\Textarea::make('description')->label('Descripción SEO'),
                        Forms\Components\TextInput::make('meta_description')->label('Meta descripción'),
                        Forms\Components\TextInput::make('og_title')->label('OG Título'),
                        Forms\Components\TextInput::make('og_description')->label('OG Descripción'),
                        Forms\Components\FileUpload::make('og_image_path')
                            ->label('Imagen OG')
                            ->image()
                            ->disk('public')
                            ->directory('seo')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml'])
                            ->preserveFilenames(),
                    ])
                    ->collapsible() // Permite colapsar manualmente
                    ->collapsed(),  // Inicia colapsada,

            ]);
    }

    public static function getNavigationUrl(): string
    {
        $setting = LightingPage::first() ?? LightingPage::create([
            'hero_text' => 'Especializados en abrir nuevos mercados te ayudamos a posicionar tu marca.',
            'section1_text' => 'Somos una empresa 100% mexicana que nace con un objetivo de comercializar bienes y servicios...',
            'section2_text' => 'Te ayudamos a recorrer el mundo con el firme propósito...',
            'section3_text' => 'Brindamos un servicio internacional, trabajando con los principales retailers del país...',
            'about_title' => '¿Quiénes somos?',
            'about_description' => 'Contenido de quiénes somos...',
            'mission_title' => 'Misión',
            'mission_description' => 'Nuestra misión es...',
            'vision_title' => 'Visión',
            'vision_description' => 'Nuestra visión es...',
            'testimonials_title' => 'Lo que dicen nuestros clientes',
            'testimonials_description' => 'Nuestros clientes opinan...',
            'services' => [], // Asegúrate de que esta columna sea tipo JSON en la base de datos
        ]);

        return static::getUrl('edit', ['record' => $setting]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table->columns([]); // Lo ocultamos
    }


    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\EditLightingPage::route('/'),
            'edit' => Pages\EditLightingPage::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Iluminación - contenido';
    }
}
