<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Tables;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Entradas del Blog';
    protected static ?string $navigationGroup = 'Contenido';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Título')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('slug')
                ->label('Slug (URL)')
                ->hint('Se autogenera si lo dejas vacío')
                ->maxLength(255),

            Forms\Components\TextInput::make('category')
                ->label('Categoría')
                ->required()
                ->maxLength(100),

            Forms\Components\FileUpload::make('image')
                ->label('Imagen principal')
                ->disk('public')
                ->directory('blog')
                ->image()
                ->imagePreviewHeight('120')
                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']),

            Forms\Components\Textarea::make('excerpt')
                ->label('Descripción corta')
                ->rows(3)
                ->maxLength(300),

            Forms\Components\RichEditor::make('content')
                ->label('Contenido')
                ->required()
                ->disableToolbarButtons(['attachFiles']),

            Forms\Components\Select::make('status')
                ->label('Estado')
                ->options([
                    'draft' => 'Borrador',
                    'published' => 'Publicado',
                ])
                ->default('draft')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')
                ->disk('public')
                ->label('Imagen')
                ->height(50),

            Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('category')->sortable(),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors([
                    'secondary' => 'draft',
                    'success' => 'published',
                ]),
            Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y'),
        ])->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return 'Entrada';
    }
}
