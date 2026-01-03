<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('thumbnail')
                    ->square()
                    ->size(50),
                \Filament\Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->title),
                \Filament\Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('gray')
                    ->placeholder('Uncategorized'),
                \Filament\Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->sortable()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'scheduled' => 'warning',
                        'archived' => 'danger',
                        default => 'gray',
                    }),
                \Filament\Tables\Columns\TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->placeholder('Not set'),
                \Filament\Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->toggleable(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'scheduled' => 'Scheduled',
                        'archived' => 'Archived',
                    ]),
                SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->preload()
                    ->searchable(),
                SelectFilter::make('author')
                    ->relationship('author', 'name')
                    ->preload()
                    ->searchable(),
                TernaryFilter::make('is_featured')
                    ->label('Featured'),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    Action::make('publish')
                        ->label('Publish')
                        ->icon('heroicon-o-globe-alt')
                        ->color('success')
                        ->requiresConfirmation()
                        ->visible(fn (Post $record): bool => $record->status !== 'published')
                        ->action(function (Post $record): void {
                            $record->update([
                                'status' => 'published',
                                'published_at' => $record->published_at ?? now(),
                            ]);
                            Notification::make()->title('Article published')->success()->send();
                        }),
                    Action::make('unpublish')
                        ->label('Unpublish')
                        ->icon('heroicon-o-eye-slash')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->visible(fn (Post $record): bool => $record->status === 'published')
                        ->action(function (Post $record): void {
                            $record->update(['status' => 'draft']);
                            Notification::make()->title('Article unpublished')->success()->send();
                        }),
                    Action::make('toggleFeatured')
                        ->label(fn (Post $record): string => $record->is_featured ? 'Unfeature' : 'Feature')
                        ->icon(fn (Post $record): string => $record->is_featured ? 'heroicon-o-star' : 'heroicon-s-star')
                        ->color('warning')
                        ->action(function (Post $record): void {
                            $record->update(['is_featured' => !$record->is_featured]);
                            $msg = $record->is_featured ? 'Article featured' : 'Article unfeatured';
                            Notification::make()->title($msg)->success()->send();
                        }),
                    Action::make('archive')
                        ->label('Archive')
                        ->icon('heroicon-o-archive-box')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(fn (Post $record): bool => $record->status !== 'archived')
                        ->action(function (Post $record): void {
                            $record->update(['status' => 'archived']);
                            Notification::make()->title('Article archived')->success()->send();
                        }),
                    Action::make('duplicate')
                        ->label('Duplicate')
                        ->icon('heroicon-o-document-duplicate')
                        ->color('gray')
                        ->action(function (Post $record): void {
                            $newPost = $record->replicate();
                            $newPost->title = $record->title . ' (Copy)';
                            $newPost->slug = null;
                            $newPost->status = 'draft';
                            $newPost->published_at = null;
                            $newPost->is_featured = false;
                            $newPost->save();
                            Notification::make()->title('Article duplicated')->success()->send();
                        }),
                ])->icon('heroicon-m-ellipsis-vertical'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('publishSelected')
                        ->label('Publish Selected')
                        ->icon('heroicon-o-globe-alt')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each(fn ($r) => $r->update(['status' => 'published', 'published_at' => $r->published_at ?? now()]))),
                    BulkAction::make('archiveSelected')
                        ->label('Archive Selected')
                        ->icon('heroicon-o-archive-box')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['status' => 'archived'])),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
