<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                \Filament\Schemas\Components\Grid::make(3)
                    ->schema([
                        \Filament\Schemas\Components\Section::make('Contact Information')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('first_name')->required(),
                                \Filament\Forms\Components\TextInput::make('last_name')->required(),
                                \Filament\Forms\Components\TextInput::make('email')->email()->required(),
                                \Filament\Forms\Components\TextInput::make('phone')->tel(),
                                \Filament\Forms\Components\TextInput::make('company'),
                            ])
                            ->columns(2)
                            ->columnSpan(2),
                        \Filament\Schemas\Components\Section::make('Management')
                            ->schema([
                                \Filament\Forms\Components\Select::make('status')
                                    ->options([
                                        'new' => 'New',
                                        'viewed' => 'Viewed',
                                        'contacted' => 'Contacted',
                                        'qualified' => 'Qualified',
                                        'lost' => 'Lost',
                                        'customer' => 'Customer',
                                    ])
                                    ->default('new')
                                    ->required(),
                                \Filament\Forms\Components\Select::make('assigned_to')
                                    ->relationship('assignee', 'name')
                                    ->searchable()
                                    ->preload(),
                                \Filament\Forms\Components\TextInput::make('source')
                                    ->placeholder('e.g. Website Contact'),
                            ])
                            ->columnSpan(1),
                        \Filament\Schemas\Components\Section::make('Inquiry')
                            ->schema([
                                \Filament\Forms\Components\TextInput::make('subject')->required()->columnSpanFull(),
                                \Filament\Forms\Components\Textarea::make('message')->required()->columnSpanFull()->rows(5),
                            ])
                            ->columnSpan(3),
                    ])
            ]);
    }
}
