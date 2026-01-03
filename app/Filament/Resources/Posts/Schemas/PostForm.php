<?php

namespace App\Filament\Resources\Posts\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                \Filament\Schemas\Components\Grid::make(['default' => 1, 'lg' => 3])
                    ->schema([
                        // Main Content Section
                        \Filament\Schemas\Components\Section::make('Content')
                            ->description('Main article content')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, ?string $state, Set $set) {
                                        if ($operation === 'create' && $state) {
                                            $set('slug', Str::slug($state));
                                            $set('seo_title', Str::limit($state, 57));
                                        }
                                    }),
                                TextInput::make('slug')
                                    ->maxLength(255)
                                    ->prefix(fn () => url('/news/'))
                                    ->helperText('Auto-generated from title. Leave blank to auto-generate.'),
                                RichEditor::make('content')
                                    ->columnSpanFull()
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsDirectory('news-attachments')
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline', 'strike',
                                        'h2', 'h3',
                                        'bulletList', 'orderedList',
                                        'link', 'blockquote',
                                        'attachFiles',
                                        'undo', 'redo',
                                    ]),
                            ])
                            ->columnSpan(['lg' => 2]),

                        // Sidebar
                        \Filament\Schemas\Components\Grid::make(1)
                            ->schema([
                                \Filament\Schemas\Components\Section::make('Publishing')
                                    ->schema([
                                        Select::make('status')
                                            ->options([
                                                'draft' => '📝 Draft',
                                                'published' => '🌐 Published',
                                                'scheduled' => '📅 Scheduled',
                                                'archived' => '📦 Archived',
                                            ])
                                            ->default('draft')
                                            ->required()
                                            ->native(false)
                                            ->live(),
                                        DateTimePicker::make('published_at')
                                            ->label('Publish Date')
                                            ->native(false)
                                            ->displayFormat('M d, Y H:i')
                                            ->default(now()),
                                        Select::make('author_id')
                                            ->label('Author')
                                            ->relationship('author', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->default(fn () => auth()->id())
                                            ->required(),
                                        Toggle::make('is_featured')
                                            ->label('Featured Article')
                                            ->helperText('Show in featured section'),
                                    ]),

                                \Filament\Schemas\Components\Section::make('Organization')
                                    ->schema([
                                        Select::make('category_id')
                                            ->label('Category')
                                            ->relationship('category', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required()
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn (?string $state, Set $set) => 
                                                        $set('slug', Str::slug($state ?? ''))
                                                    ),
                                                TextInput::make('slug')->maxLength(255),
                                                Textarea::make('description')->rows(2),
                                                Toggle::make('is_visible')->default(true),
                                            ])
                                            ->createOptionModalHeading('Create New Category'),
                                        TagsInput::make('tags')
                                            ->separator(',')
                                            ->suggestions(['news', 'update', 'guide', 'tutorial', 'announcement'])
                                            ->helperText('Press Enter to add tags'),
                                    ]),

                                \Filament\Schemas\Components\Section::make('Media')
                                    ->schema([
                                        \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                                            ->label('Featured Image')
                                            ->collection('thumbnail')
                                            ->image()
                                            ->imageEditor()
                                            ->helperText('Recommended: 1200x630px'),
                                    ]),

                                \Filament\Schemas\Components\Section::make('SEO')
                                    ->description('Search engine optimization')
                                    ->collapsed()
                                    ->schema([
                                        TextInput::make('seo_title')
                                            ->label('Meta Title')
                                            ->maxLength(60)
                                            ->helperText('Max 60 characters. Defaults to post title.'),
                                        Textarea::make('seo_description')
                                            ->label('Meta Description')
                                            ->rows(3)
                                            ->maxLength(160)
                                            ->helperText('Max 160 characters.'),
                                    ]),
                            ])
                            ->columnSpan(['lg' => 1]),
                    ]),
            ]);
    }
}
