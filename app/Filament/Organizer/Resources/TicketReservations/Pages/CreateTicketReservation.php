<?php

namespace App\Filament\Organizer\Resources\TicketReservations\Pages;

use App\Filament\Organizer\Resources\TicketReservations\TicketReservationResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Enums\Width;
use Illuminate\Database\Eloquent\Model;

class CreateTicketReservation extends CreateRecord
{
    protected static string $resource = TicketReservationResource::class;

    public function getMaxContentWidth(): Width
    {
        return Width::FiveExtraLarge;
    }

    protected function getFormActions(): array
    {
        return [];
    }
}
