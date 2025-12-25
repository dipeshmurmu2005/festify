<?php

namespace App\Filament\Organizer\Resources\BookedTickets;

use App\Filament\Organizer\Resources\BookedTickets\Pages\CreateBookedTicket;
use App\Filament\Organizer\Resources\BookedTickets\Pages\EditBookedTicket;
use App\Filament\Organizer\Resources\BookedTickets\Pages\ListBookedTickets;
use App\Filament\Organizer\Resources\BookedTickets\Pages\ViewBookedTicket;
use App\Filament\Organizer\Resources\BookedTickets\Schemas\BookedTicketForm;
use App\Filament\Organizer\Resources\BookedTickets\Schemas\BookedTicketInfolist;
use App\Filament\Organizer\Resources\BookedTickets\Tables\BookedTicketsTable;
use App\Models\BookedTicket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BookedTicketResource extends Resource
{
    protected static ?string $model = BookedTicket::class;

    // protected static string|BackedEnum|null $navigationIcon = Heroicon::Ticket;

    protected static ?string $recordTitleAttribute = 'Booked Tickets';

    protected static string | UnitEnum | null $navigationGroup = 'Reservations & Bookings';

    public static function form(Schema $schema): Schema
    {
        return BookedTicketForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BookedTicketInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookedTicketsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookedTickets::route('/'),
            'create' => CreateBookedTicket::route('/create'),
            'view' => ViewBookedTicket::route('/{record}'),
            'edit' => EditBookedTicket::route('/{record}/edit'),
        ];
    }
}
