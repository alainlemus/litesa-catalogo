<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductPhotoResource\Pages;
use App\Models\ProductPhoto;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ProductPhotoResource extends Resource
{
    protected static ?string $model = ProductPhoto::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Catalogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('path')->required(),
                Forms\Components\TextInput::make('description')->nullable(),
                Forms\Components\TextInput::make('alt_text')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('path'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('alt_text'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductPhotos::route('/'),
            'create' => Pages\CreateProductPhoto::route('/create'),
            'edit' => Pages\EditProductPhoto::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Foto de Producto';
    }
}