<?php

namespace App\Filament\Organizer\Widgets;

use App\Models\BookedTicket;
use App\Models\ReservedTicket;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class TicketsSoldChart extends ChartWidget
{
    protected ?string $heading = 'Ticket Bookings & Reservations';

    protected function getData(): array
    {
        $start = now()->startOfYear();
        $end   = now()->endOfYear();

        $months = collect(range(1, 12));

        $bookings = BookedTicket::whereBetween('created_at', [$start, $end])
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $reservations = ReservedTicket::whereBetween('created_at', [$start, $end])
            ->selectRaw('MONTH(created_at) as month, SUM(quantity) as total')
            ->groupBy('month')
            ->pluck('total', 'month');
        return [
            'datasets' => [
                [
                    'label' => 'Tickets Booked',
                    'data' => $months->map(fn($m) => $bookings[$m] ?? 0)->toArray(),
                ],
                [
                    'label' => 'Ticket Reserved',
                    'borderColor' => '#FFBF00',
                    'data' => $months->map(fn($m) => $reservations[$m] ?? 0)->toArray(),
                ],
            ],
            'labels' => $months->map(fn($m) => Carbon::create()->month($m)->format('M'))->toArray(),
        ];
    }


    protected function getType(): string
    {
        return 'line';
    }
}
