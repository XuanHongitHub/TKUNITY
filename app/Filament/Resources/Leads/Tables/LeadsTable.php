<?php

namespace App\Filament\Resources\Leads\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class LeadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->label('Contact')
                    ->state(fn ($record) => $record->full_name)
                    ->description(fn ($record) => $record->email)
                    ->searchable(['first_name', 'last_name', 'email'])
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('subject')
                    ->limit(30)
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'primary',
                        'viewed' => 'gray',
                        'contacted' => 'info',
                        'qualified' => 'success',
                        'lost' => 'danger',
                        'customer' => 'success',
                        default => 'gray',
                    }),
                \Filament\Tables\Columns\ImageColumn::make('assignee.avatar_url')
                    ->label('Assigned')
                    ->circular()
                    ->defaultImageUrl(url('https://ui-avatars.com/api/?name=U')),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
