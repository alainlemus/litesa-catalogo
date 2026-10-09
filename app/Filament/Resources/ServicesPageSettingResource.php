<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicesPageSettingResource\Pages;
use App\Filament\Support\SeoFields;
use App\Models\ServicesPageSetting;
use App\Support\Icons;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ServicesPageSettingResource extends Resource
{
    protected static ?string $model = ServicesPageSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Sitio Web';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Página de Servicios';

    public static function form(Form $form): Form
    {
        $iconSelect = fn () => Select::make('icon')->label('Ícono')->options(Icons::options())->default('star')->required();

        return $form->schema([
            Section::make('Encabezado')
                ->description('Los servicios en sí se editan en "Nosotros → Sección 4 - Servicios".')
                ->schema([
                    TextInput::make('hero_title')->label('Título')->required()->maxLength(120),
                    Textarea::make('hero_subtitle')->label('Subtítulo')->rows(2),
                ]),

            Section::make('Valores (4 tarjetas con ícono)')
                ->collapsible()->collapsed()
                ->schema([
                    Repeater::make('values')->label('Valores')->maxItems(4)
                        ->schema([
                            TextInput::make('title')->label('Título')->required(),
                            Textarea::make('text')->label('Texto')->rows(2)->required(),
                            $iconSelect(),
                        ])->itemLabel(fn (array $state) => $state['title'] ?? null)->collapsible(),
                ]),

            Section::make('Cómo trabajamos (pasos)')
                ->collapsible()->collapsed()
                ->schema([
                    Repeater::make('steps')->label('Pasos')->maxItems(6)
                        ->schema([
                            TextInput::make('title')->label('Título')->required(),
                            Textarea::make('text')->label('Texto')->rows(2)->required(),
                        ])->itemLabel(fn (array $state) => $state['title'] ?? null)->collapsible(),
                ]),

            Section::make('Sectores que atendemos')
                ->collapsible()->collapsed()
                ->schema([
                    Repeater::make('sectors')->label('Sectores')->maxItems(8)
                        ->schema([
                            TextInput::make('title')->label('Título')->required(),
                            Textarea::make('text')->label('Texto')->rows(2)->required(),
                            $iconSelect(),
                        ])->itemLabel(fn (array $state) => $state['title'] ?? null)->collapsible(),
                ]),

            Section::make('Por qué elegirnos')
                ->collapsible()->collapsed()
                ->schema([
                    Repeater::make('reasons')->label('Razones')->maxItems(8)
                        ->schema([TextInput::make('text')->label('Razón')->required()])
                        ->simple(TextInput::make('text')->label('Razón')->required()),
                ]),

            Section::make('Llamada a la acción final')
                ->collapsible()->collapsed()
                ->schema([
                    TextInput::make('cta_title')->label('Título'),
                    Textarea::make('cta_text')->label('Texto')->rows(2),
                ]),

            SeoFields::section('Título y descripción de /servicios en Google.'),
        ]);
    }

    public static function getNavigationUrl(): string
    {
        return static::getUrl('edit', ['record' => ServicesPageSetting::current()]);
    }

    public static function canCreate(): bool { return false; }
    public static function canDelete(Model $record): bool { return false; }

    public static function table(Table $table): Table
    {
        return $table->columns([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\EditServicesPageSetting::route('/'),
            'edit' => Pages\EditServicesPageSetting::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string { return 'Página de Servicios'; }
}
