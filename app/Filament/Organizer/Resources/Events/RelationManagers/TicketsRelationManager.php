<?php

namespace App\Filament\Organizer\Resources\Events\RelationManagers;

use App\Filament\Organizer\Resources\Tickets\TicketResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class TicketsRelationManager extends RelationManager
{
    protected static string $relationship = 'tickets';

    protected static ?string $relatedResource = TicketResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
