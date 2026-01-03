<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                \Filament\Schemas\Components\Grid::make(['default' => 1, 'lg' => 3])
                    ->schema([
                        // Main Info Section
                        \Filament\Schemas\Components\Section::make('User Information')
                            ->description('Basic user account details')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->autocomplete('off'),
                                TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->autocomplete('off'),
                                TextInput::make('password')
                                    ->password()
                                    ->required(fn (string $operation): bool => $operation === 'create')
                                    ->dehydrated(fn (?string $state): bool => filled($state))
                                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                                    ->minLength(8)
                                    ->autocomplete('new-password')
                                    ->helperText(fn (string $operation): string => 
                                        $operation === 'edit' ? 'Leave blank to keep current password' : 'Minimum 8 characters'
                                    ),
                                \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                                    ->label('Profile Photo')
                                    ->collection('avatars')
                                    ->image()
                                    ->avatar()
                                    ->imageEditor()
                                    ->circleCropper()
                                    ->directory('avatars'),
                            ])
                            ->columnSpan(['lg' => 2]),

                        // Sidebar
                        \Filament\Schemas\Components\Grid::make(1)
                            ->schema([
                                \Filament\Schemas\Components\Section::make('Access Control')
                                    ->schema([
                                        Select::make('status')
                                            ->options([
                                                'active' => 'Active',
                                                'inactive' => 'Inactive',
                                                'suspended' => 'Suspended',
                                            ])
                                            ->required()
                                            ->default('active')
                                            ->native(false),
                                        Select::make('roles')
                                            ->relationship('roles', 'name')
                                            ->multiple()
                                            ->preload()
                                            ->searchable()
                                            ->helperText('Assign roles to control permissions'),
                                        Toggle::make('is_super_admin')
                                            ->label('Super Administrator')
                                            ->helperText('Full access to all features')
                                            ->onColor('danger'),
                                    ]),
                                \Filament\Schemas\Components\Section::make('Activity')
                                    ->schema([
                                        Placeholder::make('last_login_at')
                                            ->label('Last Login')
                                            ->content(fn ($record): string => 
                                                $record?->last_login_at?->diffForHumans() ?? 'Never'
                                            ),
                                        Placeholder::make('created_at')
                                            ->label('Member Since')
                                            ->content(fn ($record): string => 
                                                $record?->created_at?->format('M d, Y') ?? '-'
                                            ),
                                        Placeholder::make('updated_at')
                                            ->label('Last Updated')
                                            ->content(fn ($record): string => 
                                                $record?->updated_at?->diffForHumans() ?? '-'
                                            ),
                                    ])
                                    ->visible(fn (string $operation): bool => $operation === 'edit'),
                            ])
                            ->columnSpan(['lg' => 1]),
                    ]),
            ]);
    }
}
