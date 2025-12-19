<?php

namespace App\Filament\Organizer\Resources\BookedTickets\Pages;

use App\Filament\Organizer\Resources\BookedTickets\BookedTicketResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBookedTickets extends ListRecords
{
    protected static string $resource = BookedTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
