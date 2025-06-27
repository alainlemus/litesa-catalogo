<?php

namespace App\Filament\Resources;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\SiteSettingResource\Pages\EditSiteSetting;
use App\Filament\Resources\SiteSettingResource\Pages\ListSiteSettings;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Configuración del sitio';
    protected static ?string $navigationGroup = 'Configuración';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('General')
                ->schema([
                    Forms\Components\TextInput::make('title')->required(),
                    Forms\Components\Textarea::make('description'),
                    Forms\Components\FileUpload::make('favicon')
                        ->image()
                        ->disk('public')
                        ->directory('site')
                        ->acceptedFileTypes(['image/png', 'image/svg+xml', 'image/x-icon']),
                ]),

            Forms\Components\Section::make('Logos del sitio')
                ->schema([
                    Forms\Components\FileUpload::make('logo_light')
                        ->label('Logo para tema claro')
                        ->image()
                        ->disk('public')
                        ->directory('site')
                        ->imagePreviewHeight('80')
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml']),

                    Forms\Components\FileUpload::make('logo_dark')
                        ->label('Logo para tema oscuro')
                        ->image()
                        ->disk('public')
                        ->directory('site')
                        ->imagePreviewHeight('80')
                        ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp', 'image/svg+xml']),
                ]),

            Forms\Components\Section::make('Para compartir')
                ->schema([
                    Forms\Components\TextInput::make('share_title'),
                    Forms\Components\Textarea::make('share_description'),
                    Forms\Components\FileUpload::make('share_image')
                        ->image()
                        ->disk('public')
                        ->directory('site')
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']),
                ]),

            Forms\Components\Section::make('Redes sociales')
                ->schema([
                    Forms\Components\Repeater::make('socials')
                        ->schema([
                            Forms\Components\TextInput::make('name')->required(),
                            Forms\Components\TextInput::make('url')->url()->required(),
                            Forms\Components\Textarea::make('svg')
                                ->label('Código SVG')
                                ->rows(4)
                                ->helperText('Pega el código del icono SVG'),
                        ])
                        ->columnSpanFull(),
                ]),

            Forms\Components\Section::make('Colores del sitio')
                ->columns(3)
                ->schema([
                    Forms\Components\ColorPicker::make('primary_color')->required(),
                    Forms\Components\ColorPicker::make('secondary_color')->required(),
                    Forms\Components\ColorPicker::make('tertiary_color')->required(),
                ]),
        ]);
    }

    public static function getNavigationUrl(): string
    {
        $setting = SiteSetting::first() ?? SiteSetting::create([
            'title' => 'Mi sitio',
            'primary_color' => '#000000',
            'secondary_color' => '#ffffff',
            'tertiary_color' => '#cccccc',
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
            'index' => ListSiteSettings::route('/'),
            'edit' => EditSiteSetting::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Configuraciones del sitio';
    }
}
