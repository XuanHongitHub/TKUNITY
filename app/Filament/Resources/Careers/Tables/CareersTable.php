<?php

namespace App\Filament\Resources\Careers\Tables;

use App\Models\Career;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CareersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                \Filament\Tables\Columns\TextColumn::make('department')
                    ->badge()
                    ->color('info')
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('location')
                    ->icon('heroicon-m-map-pin')
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('employment_type')
                    ->label('Type')
                    ->badge()
                    ->color('gray'),
                \Filament\Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                \Filament\Tables\Columns\TextColumn::make('posted_at')
                    ->label('Posted')
                    ->date('M d, Y')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('posted_at', 'desc')
            ->filters([
                SelectFilter::make('department')
                    ->options(fn () => Career::query()->distinct()->pluck('department', 'department')->filter()->toArray()),
                SelectFilter::make('employment_type')
                    ->label('Type')
                    ->options([
                        'full-time' => 'Full-time',
                        'part-time' => 'Part-time',
                        'contract' => 'Contract',
                        'internship' => 'Internship',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    Action::make('activate')
                        ->label('Activate')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn ($record): bool => !$record->is_active)
                        ->action(function ($record): void {
                            $record->update(['is_active' => true, 'posted_at' => $record->posted_at ?? now()]);
                            Notification::make()->title('Job posting activated')->success()->send();
                        }),
                    Action::make('deactivate')
                        ->label('Deactivate')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->visible(fn ($record): bool => $record->is_active)
                        ->action(function ($record): void {
                            $record->update(['is_active' => false]);
                            Notification::make()->title('Job posting deactivated')->success()->send();
                        }),
                    Action::make('duplicate')
                        ->label('Duplicate')
                        ->icon('heroicon-o-document-duplicate')
                        ->color('gray')
                        ->action(function ($record): void {
                            $newJob = $record->replicate();
                            $newJob->title = $record->title . ' (Copy)';
                            $newJob->slug = null;
                            $newJob->is_active = false;
                            $newJob->posted_at = null;
                            $newJob->save();
                            Notification::make()->title('Job posting duplicated')->success()->send();
                        }),
                    DeleteAction::make(),
                ])->icon('heroicon-m-ellipsis-vertical'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('activateBulk')
                        ->label('Activate Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each(fn ($r) => $r->update(['is_active' => true, 'posted_at' => $r->posted_at ?? now()]))),
                    BulkAction::make('deactivateBulk')
                        ->label('Deactivate Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->action(fn ($records) => $records->each->update(['is_active' => false])),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
