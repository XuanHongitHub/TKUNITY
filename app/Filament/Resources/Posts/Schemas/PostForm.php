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
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, \Filament\Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                                \Filament\Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                \Filament\Forms\Components\RichEditor::make('content')
                                    ->columnSpanFull(),
                                \Filament\Forms\Components\Textarea::make('excerpt')
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
                                        'archived' => 'Archived',
                                    ])
                                    ->default('draft')
                                    ->required(),
                                \Filament\Forms\Components\DateTimePicker::make('published_at'),
                                \Filament\Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->createOptionForm([
                                        \Filament\Forms\Components\TextInput::make('name')->required(),
                                        \Filament\Forms\Components\TextInput::make('slug')->required(),
                                    ]),
                                \Filament\Forms\Components\TagsInput::make('tags'),
                                \Filament\Forms\Components\FileUpload::make('featured_image')
                                    ->image()
                                    ->directory('posts'),
                                \Filament\Forms\Components\Checkbox::make('is_featured'),
                            ])->columnSpan(['md' => 1]), // Sidebar
                    ])
            ]);
    }
}
