<?php

namespace App\Filament\Resources\Leads\Tables;

use App\Models\Lead;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
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
                    ->searchable()
                    ->tooltip(fn ($record) => $record->subject),
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
                    ->label('Received')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'viewed' => 'Viewed',
                        'contacted' => 'Contacted',
                        'qualified' => 'Qualified',
                        'lost' => 'Lost',
                        'customer' => 'Customer',
                    ]),
                SelectFilter::make('assignee')
                    ->relationship('assignee', 'name')
                    ->preload()
                    ->searchable(),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    Action::make('markViewed')
                        ->label('Mark as Viewed')
                        ->icon('heroicon-o-eye')
                        ->color('gray')
                        ->visible(fn (Lead $record): bool => $record->status === 'new')
                        ->action(function (Lead $record): void {
                            $record->update(['status' => 'viewed']);
                            Notification::make()->title('Marked as viewed')->success()->send();
                        }),
                    Action::make('markContacted')
                        ->label('Mark as Contacted')
                        ->icon('heroicon-o-phone')
                        ->color('info')
                        ->visible(fn (Lead $record): bool => in_array($record->status, ['new', 'viewed']))
                        ->action(function (Lead $record): void {
                            $record->update(['status' => 'contacted']);
                            Notification::make()->title('Marked as contacted')->success()->send();
                        }),
                    Action::make('qualify')
                        ->label('Qualify Lead')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn (Lead $record): bool => !in_array($record->status, ['qualified', 'customer', 'lost']))
                        ->action(function (Lead $record): void {
                            $record->update(['status' => 'qualified']);
                            Notification::make()->title('Lead qualified')->success()->send();
                        }),
                    Action::make('markLost')
                        ->label('Mark as Lost')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn (Lead $record): bool => $record->status !== 'lost')
                        ->action(function (Lead $record): void {
                            $record->update(['status' => 'lost']);
                            Notification::make()->title('Lead marked as lost')->success()->send();
                        }),
                ])->icon('heroicon-m-ellipsis-vertical'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('markViewedBulk')
                        ->label('Mark as Viewed')
                        ->icon('heroicon-o-eye')
                        ->action(fn ($records) => $records->each->update(['status' => 'viewed'])),
                    BulkAction::make('markContactedBulk')
                        ->label('Mark as Contacted')
                        ->icon('heroicon-o-phone')
                        ->action(fn ($records) => $records->each->update(['status' => 'contacted'])),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
