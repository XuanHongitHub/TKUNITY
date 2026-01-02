<?php

namespace App\Filament\Resources\NewsletterSubscriptions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;

class NewsletterSubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable(),
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'subscribed' => 'success',
                        'unsubscribed' => 'gray',
                        default => 'gray',
                    }),
                \Filament\Tables\Columns\TextColumn::make('source')
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('subscribed_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
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
