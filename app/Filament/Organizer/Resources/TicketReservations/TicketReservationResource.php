<?php

namespace App\Filament\Organizer\Resources\TicketReservations;

use App\Filament\Organizer\Resources\TicketReservations\Pages\CreateTicketReservation;
use App\Filament\Organizer\Resources\TicketReservations\Pages\EditTicketReservation;
use App\Filament\Organizer\Resources\TicketReservations\Pages\ListTicketReservations;
use App\Filament\Organizer\Resources\TicketReservations\Pages\ViewTicketReservation;
use App\Filament\Organizer\Resources\TicketReservations\Schemas\TicketReservationForm;
use App\Filament\Organizer\Resources\TicketReservations\Schemas\TicketReservationInfolist;
use App\Filament\Organizer\Resources\TicketReservations\Tables\TicketReservationsTable;
use App\Models\TicketReservation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TicketReservationResource extends Resource
{
    protected static ?string $model = TicketReservation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDateRange;

    protected static ?string $recordTitleAttribute = 'ticket_reservation';

    public static function form(Schema $schema): Schema
    {
        return TicketReservationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TicketReservationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TicketReservationsTable::configure($table);
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
            'index' => ListTicketReservations::route('/'),
            'view' => ViewTicketReservation::route('/{record}'),
            'edit' => EditTicketReservation::route('/{record}/edit'),
        ];
    }
}
