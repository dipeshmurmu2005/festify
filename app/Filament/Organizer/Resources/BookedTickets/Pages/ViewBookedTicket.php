<?php

namespace App\Filament\Organizer\Resources\BookedTickets\Pages;

use App\Filament\Organizer\Resources\BookedTickets\BookedTicketResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBookedTicket extends ViewRecord
{
    protected static string $resource = BookedTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
