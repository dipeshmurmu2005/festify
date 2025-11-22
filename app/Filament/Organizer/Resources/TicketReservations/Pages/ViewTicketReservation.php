<?php

namespace App\Filament\Organizer\Resources\TicketReservations\Pages;

use App\Filament\Organizer\Resources\TicketReservations\TicketReservationResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewTicketReservation extends ViewRecord
{
    protected static string $resource = TicketReservationResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Reservation #' . $this->record->reservation_code;
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Convert to Booked')->color('success')->action(function ($record) {
                dd($record);
            })
        ];
    }
}
