<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Forms\Form;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('path')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('photos')
                    ->preserveFilenames()
                    ->minFiles(1) // Mínimo 1 imagen
                    ->maxFiles(5) // Máximo 5 imágenes
                    ->helperText('Sube entre 1 y 5 imágenes para el producto'),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255)
                    ->helperText('Descripción opcional de la foto'),
                Forms\Components\TextInput::make('alt_text')
                    ->maxLength(255)
                    ->helperText('Texto alternativo para la imagen'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('path')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('alt_text'),
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