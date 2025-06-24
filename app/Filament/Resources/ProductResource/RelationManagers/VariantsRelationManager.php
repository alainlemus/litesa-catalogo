<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Forms\Form;

class VariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('variant_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pcs')
                    ->required()
                    ->numeric()
                    ->minValue(1),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('size')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('power')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('lumen')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('voltage')
                    ->required()
                    ->maxLength(20),
                Forms\Components\Select::make('color_temperature_id')
                    ->relationship('colorTemperature', 'value')
                    ->searchable()
                    ->required()
                    ->preload(),
            ]);
    }

    public function table(Table $table): Table
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
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}