<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', \App\Models\User::count())
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('New Leads', \App\Models\Lead::where('status', 'new')->count())
                ->description('Inquiries needing attention')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('primary'),
            Stat::make('Published Posts', \App\Models\Post::where('status', 'published')->count())
                ->description('Live content')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),
        ];
    }
}
