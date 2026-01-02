<?php

namespace App\Filament\Resources\NewsletterSubscriptions\Schemas;

use Filament\Schemas\Schema;

class NewsletterSubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                \Filament\Schemas\Components\Section::make('Subscriber')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        \Filament\Forms\Components\TextInput::make('name')
                            ->maxLength(255),
                        \Filament\Forms\Components\Select::make('status')
                            ->options([
                                'subscribed' => 'Subscribed',
                                'unsubscribed' => 'Unsubscribed',
                            ])
                            ->default('subscribed')
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('source')
                            ->maxLength(255),
                        \Filament\Forms\Components\DateTimePicker::make('subscribed_at')
                            ->default(fn () => now()),
                        \Filament\Forms\Components\DateTimePicker::make('unsubscribed_at'),
                    ])
                    ->columns(2),
            ]);
    }
}
