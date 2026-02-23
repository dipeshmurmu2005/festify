<?php

namespace App\Filament\Organizer\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WalletStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Balance', 'Rs.' . 3902)
                ->color('success'),
        ];
    }
}
