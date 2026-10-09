<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationGroup = 'Sitio Web';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Preguntas frecuentes';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('question')->label('Pregunta')->required()->maxLength(255)->columnSpanFull(),
            Textarea::make('answer')->label('Respuesta')->required()->rows(5)->columnSpanFull(),
            Toggle::make('is_active')->label('Visible en el sitio')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')->label('Pregunta')->searchable()->wrap(),
                ToggleColumn::make('is_active')->label('Visible'),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->actions([EditAction::make()])
            ->bulkActions([DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string { return 'Pregunta frecuente'; }
    public static function getPluralModelLabel(): string { return 'Preguntas frecuentes'; }
}
