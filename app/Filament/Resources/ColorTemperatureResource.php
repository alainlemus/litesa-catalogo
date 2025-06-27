<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ColorTemperatureResource\Pages;
use App\Models\ColorTemperature;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;

class ColorTemperatureResource extends Resource
{
    protected static ?string $model = ColorTemperature::class;
    protected static ?string $navigationIcon = 'heroicon-o-fire';
    protected static ?string $navigationGroup = 'Catalogo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('value')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('value'),
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
            'index' => Pages\ListColorTemperatures::route('/'),
            'create' => Pages\CreateColorTemperature::route('/create'),
            'edit' => Pages\EditColorTemperature::route('/{record}/edit'),
        ];
    }
}