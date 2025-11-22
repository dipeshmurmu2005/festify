<?php

namespace App\Filament\Organizer\Resources\TicketReservations\Pages;

use App\Filament\Organizer\Resources\TicketReservations\TicketReservationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTicketReservation extends EditRecord
{
    protected static string $resource = TicketReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
