<?php

namespace App\Filament\Organizer\Resources\Tickets\Schemas;

use App\Models\Event;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('event_id')->label('Event')->options(Event::pluck('title', 'id'))->disabled()->dehydrated(),
            ]);
    }
}
