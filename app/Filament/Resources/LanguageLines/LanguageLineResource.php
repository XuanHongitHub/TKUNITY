<?php

namespace App\Filament\Resources\LanguageLines;

use App\Filament\Resources\LanguageLines\Pages\ManageLanguageLines;
use App\Models\LanguageLine;
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

class LanguageLineResource extends Resource
{
    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('group')
                    ->required()
                    ->default('*'),
                TextInput::make('key')
                    ->required(),
                \Filament\Forms\Components\KeyValue::make('text')
                    ->label('Translations')
                    ->keyLabel('Locale (en, vi)')
                    ->valueLabel('Text')
                    ->reorderable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('key')
            ->columns([
                TextColumn::make('group')->sortable()->searchable(),
                TextColumn::make('key')->sortable()->searchable(),
                TextColumn::make('text')
                    ->formatStateUsing(fn ($state) => count($state) . ' languages')
                    ->badge(),
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
            'index' => ManageLanguageLines::route('/'),
        ];
    }
}
