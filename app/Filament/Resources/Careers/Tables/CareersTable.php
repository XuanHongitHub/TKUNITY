<?php

namespace App\Filament\Resources\Careers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;

class CareersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->weight('bold'),
                \Filament\Tables\Columns\TextColumn::make('department')
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('location')
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('employment_type')
                    ->label('Type')
                    ->badge()
                    ->color('gray')
                    ->toggleable(),
                \Filament\Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                \Filament\Tables\Columns\TextColumn::make('posted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
}
