<?php

namespace App\Filament\Organizer\Widgets;

use App\Services\Organizer\WalletStatsService;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WalletStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $walletService = new WalletStatsService();
        return [
            Stat::make('Balance', 'Rs.' . $walletService->balance())
                ->color('success'),
        ];
    }
}
