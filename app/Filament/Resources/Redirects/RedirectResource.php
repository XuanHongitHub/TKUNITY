<?php

namespace App\Filament\Resources\Redirects;

use App\Filament\Resources\Redirects\Pages\ManageRedirects;
use App\Models\Redirect;
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

class RedirectResource extends Resource
{
    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowsRightLeft;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('source')
                    ->required()
                    ->prefix('/')
                    ->unique(ignoreRecord: true),
                TextInput::make('destination')
                    ->required()
                    ->prefix('/'),
                \Filament\Forms\Components\Select::make('code')
                    ->options([
                        301 => '301 - Permanent',
                        302 => '302 - Temporary',
                    ])
                    ->default(301)
                    ->required(),
                \Filament\Forms\Components\Toggle::make('active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('source')
            ->columns([
                TextColumn::make('source')->searchable()->sortable(),
                TextColumn::make('destination')->searchable(),
                TextColumn::make('code')->badge()->color('warning'),
                \Filament\Tables\Columns\IconColumn::make('active')->boolean(),
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
            'index' => ManageRedirects::route('/'),
        ];
    }
}
