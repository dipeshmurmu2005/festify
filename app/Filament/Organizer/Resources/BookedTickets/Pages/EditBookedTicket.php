<?php

namespace App\Filament\Organizer\Resources\BookedTickets\Pages;

use App\Filament\Organizer\Resources\BookedTickets\BookedTicketResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBookedTicket extends EditRecord
{
    protected static string $resource = BookedTicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
