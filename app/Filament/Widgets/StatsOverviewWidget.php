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
                ->color('success'),
            Stat::make('Published News', \App\Models\Post::where('status', 'published')->count())
                ->description('Live updates')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),
            Stat::make('Contact Requests', \App\Models\Lead::where('status', 'new')->count())
                ->description('Needs attention')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('primary'),
            Stat::make('Newsletter Subscribers', \App\Models\NewsletterSubscription::where('status', 'subscribed')->count())
                ->description('Active audience')
                ->descriptionIcon('heroicon-m-bell')
                ->color('warning'),
        ];
    }
}
