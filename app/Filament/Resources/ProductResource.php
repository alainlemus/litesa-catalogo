<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = 'Catalogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('warranty')
                    ->label('Garantía')
                    ->maxLength(255),
                Forms\Components\TextInput::make('power_factor')
                    ->label('Factor de Potencia')
                    ->maxLength(255),
                Forms\Components\TextInput::make('base')
                    ->label('Base')
                    ->maxLength(255),
                Forms\Components\TextInput::make('certification')
                    ->label('Certificación')
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->label('Categoría')
                    ->relationship('category', 'name')

                    ->required(),
                Forms\Components\Select::make('uses')
                ->label("Usos")
                ->relationship('uses', 'name')
                ->multiple()
                ->searchable()
                ->preload() // Opcional: precarga las opciones
                ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Descripción')
                    ->rows(5)
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label("Nombre"),
                Tables\Columns\TextColumn::make('warranty')->label("Garantía"),
                Tables\Columns\TextColumn::make('power_factor')->label("Factor de Potencia"),
                Tables\Columns\TextColumn::make('base')->label("Base"),
                Tables\Columns\TextColumn::make('certification')->label("Certificación "),
                Tables\Columns\TextColumn::make('uses.name')->label('Usos')->sortable(),
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\VariantsRelationManager::class,
            RelationManagers\PhotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Producto';
    }
}
