<?php

namespace App\Filament\Organizer\Widgets;

use App\Models\Expense;
use App\Services\Organizer\OrganizerStatsService;
use Filament\Widgets\ChartWidget;

class ExpensesChart extends ChartWidget
{
    protected ?string $heading = 'Expenses & Revenue Chart';

    protected function getData(): array
    {
        $stats = app(OrganizerStatsService::class);

        $totalRevenue = $stats->totalRevenue();
        $totalExpense = Expense::sum('amount');

        return [
            'datasets' => [
                [
                    'data' => [
                        $totalRevenue,
                        $totalExpense,
                    ],
                    'backgroundColor' => [
                        '#22c55e', // green
                        '#f97316', // orange
                    ],
                ],
            ],
            'labels' => [
                'Revenue',
                'Expense',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
