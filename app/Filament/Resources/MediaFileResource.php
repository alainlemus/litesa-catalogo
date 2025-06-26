<?php

namespace App\Filament\Resources;

use App\Models\MediaFile;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Filament\Resources\MediaFileResource\Pages;

class MediaFileResource extends Resource
{
    protected static ?string $model = MediaFile::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Media';
    protected static ?string $navigationLabel = 'Imágenes';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),

            Forms\Components\FileUpload::make('path')
                ->label('Imagen')
                ->image()
                ->disk('public')
                ->directory('uploads')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                ->required()
                ->imagePreviewHeight('150')
                ->preserveFilenames()
                ->afterStateUpdated(function ($state, callable $set) {
                    $extension = Str::afterLast($state, '.');
                    $set('extension', $extension);
                }),

            Forms\Components\Hidden::make('extension'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('path')
                ->disk('public')
                ->label('Imagen')
                ->height(50),

            TextColumn::make('name')->searchable(),
            TextColumn::make('extension')->label('Tipo'),
            TextColumn::make('created_at')->dateTime('d M Y'),
        ])
        ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMediaFiles::route('/'),
            'create' => Pages\CreateMediaFile::route('/create'),
            'edit' => Pages\EditMediaFile::route('/{record}/edit'),
        ];
    }
}
