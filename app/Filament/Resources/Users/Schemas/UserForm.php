<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use App\Filament\Resources\Users\Pages\CreateUser;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                \Filament\Schemas\Components\Section::make()
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('password')
                            ->password()
                            ->required(fn ($operation) => $operation === 'create')
                            ->dehydrated(fn ($state) => filled($state)),
                        \Filament\Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),
                        \Filament\Forms\Components\FileUpload::make('avatar_url')
                            ->label('Avatar')
                            ->image()
                            ->avatar()
                            ->directory('avatars'),
                    ]),
                 \Filament\Schemas\Components\Section::make('Access Control')
                    ->schema([
                        \Filament\Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                                'banned' => 'Banned',
                            ])
                            ->required()
                            ->default('active'),
                        Toggle::make('is_super_admin')
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
