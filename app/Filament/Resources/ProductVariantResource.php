<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductVariantResource\Pages;
use App\Models\ProductVariant;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ProductVariantResource extends Resource
{
    protected static ?string $model = ProductVariant::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Catalogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('variant_id')->required(),
                Forms\Components\TextInput::make('pcs')->required(),
                Forms\Components\TextInput::make('description')->required(),
                Forms\Components\TextInput::make('size')->required(),
                Forms\Components\TextInput::make('power')->required(),
                Forms\Components\TextInput::make('lumen')->required(),
                Forms\Components\TextInput::make('voltage')->required(),
                Forms\Components\Select::make('color_temperature_id')
                    ->relationship('colorTemperature', 'value')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('variant_id'),
                Tables\Columns\TextColumn::make('pcs'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('size'),
                Tables\Columns\TextColumn::make('power'),
                Tables\Columns\TextColumn::make('lumen'),
                Tables\Columns\TextColumn::make('voltage'),
                Tables\Columns\TextColumn::make('colorTemperature.value')->label('Color Temperature'),
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
            'index' => Pages\ListProductVariants::route('/'),
            'create' => Pages\CreateProductVariant::route('/create'),
            'edit' => Pages\EditProductVariant::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Variante de Producto';
    }
}