<?php

namespace App\Filament\Resources\Careers\Schemas;

use Filament\Schemas\Schema;

class CareerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                \Filament\Schemas\Components\Grid::make(['default' => 1, 'md' => 3])
                    ->schema([
                        \Filament\Schemas\Components\Section::make('Role Details')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, \Filament\Forms\Set $set) => $operation === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null),
                                \Filament\Forms\Components\TextInput::make('slug')
                                    ->maxLength(255)
                                    ->helperText('Auto-generated from title if left blank. Duplicate slugs will be adjusted.'),
                                \Filament\Forms\Components\TextInput::make('department')
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('location')
                                    ->maxLength(255),
                                \Filament\Forms\Components\TextInput::make('employment_type')
                                    ->label('Employment Type')
                                    ->maxLength(255),
                            ])
                            ->columns(2)
                            ->columnSpan(['md' => 2]),
                        \Filament\Schemas\Components\Section::make('Publishing')
                            ->schema([
                                \Filament\Forms\Components\DateTimePicker::make('posted_at'),
                                \Filament\Forms\Components\Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true),
                                \Filament\Forms\Components\TextInput::make('apply_url')
                                    ->label('Apply URL')
                                    ->url()
                                    ->helperText('Optional link to an external application form.')
                                    ->maxLength(255),
                                \Filament\Forms\Components\Textarea::make('summary')
                                    ->helperText('Short summary for quick listings.')
                                    ->rows(4),
                            ])
                            ->columnSpan(['md' => 1]),
                        \Filament\Schemas\Components\Section::make('Description')
                            ->schema([
                                \Filament\Forms\Components\RichEditor::make('description')
                                    ->columnSpanFull(),
                            ])
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
