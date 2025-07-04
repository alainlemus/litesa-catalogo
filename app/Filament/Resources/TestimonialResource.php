<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationLabel = 'Testimonios';
    protected static ?string $navigationGroup = 'Sitio Web';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Testimmonios')
                ->description('Crea y edita testimonios de clientes')
                ->columns(2)
                ->columnSpanFull()
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nombre')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('position')
                        ->label('Puesto')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Textarea::make('message')
                        ->label('Mensaje')
                        ->required()
                        ->rows(5),

                    Forms\Components\FileUpload::make('image')
                        ->label('Imagen')
                        ->image()
                        ->disk('public')
                        ->directory('testimonials')
                        ->imagePreviewHeight('100')
                        ->acceptedFileTypes(['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/svg+xml'])
                        ->hint('Sube una imagen cuadrada o circular del testimonio.'),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->circular()
                    ->height(40)
                    ->label('Foto'),

                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
                Tables\Columns\TextColumn::make('position')->label('Puesto'),
                Tables\Columns\TextColumn::make('message')->label('Mensaje')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label('Fecha de creación')->dateTime('d M Y'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Testimonio';
    }
}
