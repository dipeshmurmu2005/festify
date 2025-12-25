<?php

namespace App\Filament\Organizer\Resources\Tickets\Pages;

use App\Filament\Organizer\Resources\Tickets\TicketResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\Width;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    public function getMaxContentWidth(): Width
    {
        return Width::FiveExtraLarge;
    }


    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
