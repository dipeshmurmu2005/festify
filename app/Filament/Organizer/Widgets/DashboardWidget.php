<?php

namespace App\Filament\Organizer\Widgets;

use App\Services\Organizer\OrganizerStatsService;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $stats = app(OrganizerStatsService::class);
        return [
            Stat::make('Total Revenue', $stats->ticketsSold())
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Ticket Sold', $stats->ticketsSold())
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Active Reservations', $stats->activeReservation())
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
