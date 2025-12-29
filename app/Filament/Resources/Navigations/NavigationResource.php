<?php

namespace App\Filament\Resources\Navigations;

use App\Filament\Resources\Navigations\Pages\ManageNavigations;
use App\Models\Navigation;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NavigationResource extends Resource
{
    protected static ?string $model = Navigation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return 'Appearance';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                \Filament\Schemas\Components\Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, \Filament\Forms\Set $set) => $operation === 'create' ? $set('handle', \Illuminate\Support\Str::slug($state)) : null),
                        TextInput::make('handle')
                            ->required()
                            ->unique(ignoreRecord: true),
                        \Filament\Forms\Components\Repeater::make('items')
                            ->schema([
                                TextInput::make('label')->required(),
                                \Filament\Forms\Components\Select::make('type')
                                    ->options([
                                        'url' => 'External Link',
                                        'route' => 'Internal Route',
                                        'page' => 'CMS Page',
                                    ])
                                    ->default('url')
                                    ->live(),
                                TextInput::make('url')
                                    ->required(fn (\Filament\Forms\Get $get) => $get('type') === 'url')
                                    ->visible(fn (\Filament\Forms\Get $get) => $get('type') === 'url'),
                                TextInput::make('route')
                                    ->required(fn (\Filament\Forms\Get $get) => $get('type') === 'route')
                                    ->visible(fn (\Filament\Forms\Get $get) => $get('type') === 'route'),
                                \Filament\Forms\Components\Select::make('target')
                                    ->options([
                                        '_self' => 'Same Tab',
                                        '_blank' => 'New Tab',
                                    ])
                                    ->default('_self'),
                                \Filament\Forms\Components\Repeater::make('children')
                                    ->label('Sub-Items')
                                    ->schema([
                                        TextInput::make('label')->required(),
                                        TextInput::make('url'),
                                    ])
                                    ->collapsible(),
                            ])
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageNavigations::route('/'),
        ];
    }
}
