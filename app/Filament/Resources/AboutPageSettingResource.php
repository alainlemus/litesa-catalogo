<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AboutPageSettingResource\Pages;
use App\Models\AboutPageSetting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Model;

class AboutPageSettingResource extends Resource
{
    protected static ?string $model = AboutPageSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Sitio Web';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make('Sección 1')
                    ->schema([
                        FileUpload::make('hero_image')
                            ->label('Imagen principal')
                            ->image()
                            ->disk('public')
                            ->directory('nosotros')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml']),
                        TiptapEditor::make('hero_text')
                            ->label('Título sección 1')
                            ->profile('default') // puedes usar 'full' para más botones
                            ->helperText('Puedes usar etiquetas HTML como <h2>, <span>, etc.'),
                        Textarea::make('section1_text')
                            ->label('Texto sección 1'),

                    ])
                    ->collapsible(), // Permite colapsar manualmente

                Section::make('Sección 2')
                    ->schema([
                        TiptapEditor::make('section2_text')
                            ->label('Texto sección 2')
                            ->profile('default') // puedes usar 'full' para más botones
                            ->helperText('Puedes usar etiquetas HTML como <h2>, <span>, etc.'),
                        FileUpload::make('section2_image')
                            ->label('Imagen sección 2')
                            ->image()
                            ->disk('public')
                            ->directory('nosotros')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml']),
                        TiptapEditor::make('section3_text')
                            ->label('Texto descripción sección 2')
                            ->profile('default') // puedes usar 'full' para más botones
                            ->helperText('Puedes usar etiquetas HTML como <h2>, <span>, etc.'),
                    ])
                    ->collapsible() // Permite colapsar manualmente
                    ->collapsed(),  // Inicia colapsada

                Section::make('Sección 3 - ¿Quienes somos?')
                    ->schema([
                        TextInput::make('about_title'),
                        Textarea::make('about_description'),
                        Textarea::make('about_svg'),

                        TextInput::make('mission_title'),
                        Textarea::make('mission_description'),
                        Textarea::make('mission_svg'),

                        TextInput::make('vision_title'),
                        Textarea::make('vision_description'),
                        Textarea::make('vision_svg'),
                    ])
                    ->collapsible() // Permite colapsar manualmente
                    ->collapsed(),  // Inicia colapsada

                Section::make('Sección 4 - Servicios')
                    ->schema([
                        Repeater::make('services')
                            ->schema([
                                Textarea::make('svg')->label('SVG'),
                                TextInput::make('title')->label('Título'),
                                Textarea::make('description')->label('Descripción'),
                                TextInput::make('url'),
                            ])
                            ->label('Servicios')
                            ->columns(1),
                    ])
                    ->collapsible() // Permite colapsar manualmente
                    ->collapsed(),  // Inicia colapsada

                Section::make('Sección 5 - Testimonios')
                    ->schema([
                        TiptapEditor::make('testimonials_title')
                            ->label('Título testimonios')
                            ->profile('default') // puedes usar 'full' para más botones
                            ->helperText('Puedes usar etiquetas HTML como <h2>, <span>, etc.'),
                        Textarea::make('testimonials_description')->label('Descripción testimonios'),
                    ])
                    ->collapsible() // Permite colapsar manualmente
                    ->collapsed(),  // Inicia colapsada
            ]);
    }

    public static function getNavigationUrl(): string
    {
        $setting = AboutPageSetting::first() ?? AboutPageSetting::create([
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
            'services' => [],
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
            'index' => Pages\EditAboutPageSetting::route('/'),
            'edit' => Pages\EditAboutPageSetting::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Nosotros';
    }
}
