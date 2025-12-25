<?php

namespace App\Filament\Widgets;

use App\Services\Admin\StatsService;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $stats = app(StatsService::class);
        return [
            Stat::make('Total Organizers', $stats->totalOrganizers())
                ->color('success'),
            Stat::make('Total Users', $stats->totalUsers())
                ->color('success'),
            Stat::make('Tickets Sold', $stats->ticketsSold())
                ->color('success'),
            Stat::make('Active Reservations', $stats->activeReservation())
                ->color('success'),
        ];
    }
}
