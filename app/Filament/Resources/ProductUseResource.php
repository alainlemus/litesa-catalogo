<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductUseResource\Pages;
use App\Models\ProductUse;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ProductUseResource extends Resource
{
    protected static ?string $model = ProductUse::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Catalogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nombre')->searchable(),
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
            'index' => Pages\ListProductUses::route('/'),
            'create' => Pages\CreateProductUse::route('/create'),
            'edit' => Pages\EditProductUse::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Uso';
    }
}
