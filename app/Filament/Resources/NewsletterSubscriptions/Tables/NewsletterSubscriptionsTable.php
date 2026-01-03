<?php

namespace App\Filament\Resources\NewsletterSubscriptions\Tables;

use App\Models\NewsletterSubscription;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class NewsletterSubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->icon('heroicon-m-envelope'),
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->placeholder('Not provided')
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'subscribed' => 'success',
                        'unsubscribed' => 'danger',
                        'pending' => 'warning',
                        default => 'gray',
                    }),
                \Filament\Tables\Columns\TextColumn::make('source')
                    ->badge()
                    ->color('gray')
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('subscribed_at')
                    ->label('Subscribed')
                    ->dateTime('M d, Y')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('subscribed_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'subscribed' => 'Subscribed',
                        'unsubscribed' => 'Unsubscribed',
                        'pending' => 'Pending',
                    ]),
                SelectFilter::make('source')
                    ->options(fn () => NewsletterSubscription::query()
                        ->distinct()
                        ->whereNotNull('source')
                        ->pluck('source', 'source')
                        ->toArray()
                    ),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    Action::make('resubscribe')
                        ->label('Resubscribe')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn ($record): bool => $record->status !== 'subscribed')
                        ->action(function ($record): void {
                            $record->update(['status' => 'subscribed', 'subscribed_at' => now()]);
                            Notification::make()->title('Subscriber reactivated')->success()->send();
                        }),
                    Action::make('unsubscribe')
                        ->label('Unsubscribe')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn ($record): bool => $record->status === 'subscribed')
                        ->action(function ($record): void {
                            $record->update(['status' => 'unsubscribed']);
                            Notification::make()->title('Subscriber removed')->success()->send();
                        }),
                    DeleteAction::make(),
                ])->icon('heroicon-m-ellipsis-vertical'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('exportSelected')
                        ->label('Export Selected')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function ($records) {
                            // Simple CSV export
                            $csv = "Email,Name,Status,Subscribed At\n";
                            foreach ($records as $record) {
                                $csv .= "{$record->email},{$record->name},{$record->status},{$record->subscribed_at}\n";
                            }
                            return response()->streamDownload(function () use ($csv) {
                                echo $csv;
                            }, 'subscribers-' . now()->format('Y-m-d') . '.csv');
                        }),
                    BulkAction::make('unsubscribeBulk')
                        ->label('Unsubscribe Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['status' => 'unsubscribed'])),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
