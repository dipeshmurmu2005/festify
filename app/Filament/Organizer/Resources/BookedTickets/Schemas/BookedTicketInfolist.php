<?php

namespace App\Filament\Organizer\Resources\BookedTickets\Schemas;

use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Schema;

class BookedTicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ViewEntry::make('ticket')->view('components.elements.booked-ticket-filament', function ($record) {
                    return ['ticket' => $record];
                })
            ]);
    }
}
