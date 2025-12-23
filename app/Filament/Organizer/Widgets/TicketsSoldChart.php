<?php

namespace App\Filament\Organizer\Widgets;

use Filament\Widgets\ChartWidget;

class TicketsSoldChart extends ChartWidget
{
    protected ?string $heading = 'Ticket Bookings & Reservations';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Tickets Sold',
                    'data' => [32, 32, 120, 80, 200, 150, 300],
                ],
            ],
            'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
