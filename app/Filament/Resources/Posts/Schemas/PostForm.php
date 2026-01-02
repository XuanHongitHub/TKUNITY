<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                \Filament\Schemas\Components\Grid::make(['default' => 1, 'md' => 3])
                    ->schema([
                        \Filament\Schemas\Components\Section::make('Main Content')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, \Filament\Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                                \Filament\Forms\Components\TextInput::make('slug')
                                    ->maxLength(255)
                                    ->helperText('Auto-generated from title if left blank. Duplicate slugs will be adjusted.'),
                                \Filament\Forms\Components\RichEditor::make('content')
                                    ->columnSpanFull(),
                                \Filament\Forms\Components\Textarea::make('excerpt')
                                    ->helperText('Optional summary for news cards and previews.')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(['md' => 2]),
                        \Filament\Schemas\Components\Section::make('Meta')
                            ->schema([
                                \Filament\Forms\Components\Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'scheduled' => 'Scheduled',
                                        'archived' => 'Archived',
                                    ])
                                    ->default('draft')
                                    ->required(),
                                \Filament\Forms\Components\DateTimePicker::make('published_at'),
                                \Filament\Forms\Components\Select::make('author_id')
                                    ->relationship('author', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->default(fn () => auth()->id()),
                                \Filament\Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        \Filament\Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (string $operation, $state, \Filament\Forms\Set $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                                        \Filament\Forms\Components\TextInput::make('slug')
                                            ->maxLength(255)
                                            ->helperText('Auto-generated. Duplicate slugs will be adjusted.'),
                                        \Filament\Forms\Components\Textarea::make('description')->rows(2),
                                        \Filament\Forms\Components\Toggle::make('is_visible')->default(true),
                                    ]),
                                \Filament\Forms\Components\TagsInput::make('tags')
                                    ->helperText('Optional keywords for filtering and search.'),
                                \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                                    ->label('Thumbnail')
                                    ->collection('thumbnail')
                                    ->image()
                                    ->imageEditor(),
                                \Filament\Forms\Components\Checkbox::make('is_featured'),
                                \Filament\Forms\Components\TextInput::make('seo_title')
                                    ->label('SEO Title')
                                    ->helperText('Defaults to the post title when left empty.')
                                    ->maxLength(60),
                                \Filament\Forms\Components\Textarea::make('seo_description')
                                    ->label('SEO Description')
                                    ->helperText('Defaults to the post excerpt when left empty.')
                                    ->rows(3)
                                    ->maxLength(160),
                            ])->columnSpan(['md' => 1]), // Sidebar
                    ])
            ]);
    }
}
