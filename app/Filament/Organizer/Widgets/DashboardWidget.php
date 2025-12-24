<?php

namespace App\Filament\Organizer\Widgets;

use App\Services\Organizer\OrganizerStatsService;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $stats = app(OrganizerStatsService::class);
        return [
            Stat::make('Total Revenue', 'Rs. ' . $stats->totalRevenue())
                ->color('success'),
            Stat::make('Ticket Sold', $stats->ticketsSold())
                ->color('success'),
            Stat::make('Active Reservations', $stats->activeReservation())
                ->color('success'),
            Stat::make('Wallet Balance', $stats->walletBalance())
                ->icon(Heroicon::Wallet)
                ->color('success'),
        ];
    }
}
