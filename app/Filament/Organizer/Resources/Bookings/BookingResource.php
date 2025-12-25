<?php

namespace App\Filament\Organizer\Resources\Bookings;

use App\Filament\Organizer\Resources\Bookings\Pages\CreateBooking;
use App\Filament\Organizer\Resources\Bookings\Pages\EditBooking;
use App\Filament\Organizer\Resources\Bookings\Pages\ListBookings;
use App\Filament\Organizer\Resources\Bookings\Pages\ViewBooking;
use App\Filament\Organizer\Resources\Bookings\Schemas\BookingForm;
use App\Filament\Organizer\Resources\Bookings\Schemas\BookingInfolist;
use App\Filament\Organizer\Resources\Bookings\Tables\BookingsTable;
use App\Models\Booking;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $recordTitleAttribute = 'Booking Resource';

    protected static string | UnitEnum | null $navigationGroup = 'Reservations & Bookings';

    public static function form(Schema $schema): Schema
    {
        return BookingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BookingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookingsTable::configure($table);
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
            'index' => ListBookings::route('/'),
            'create' => CreateBooking::route('/create'),
            'view' => ViewBooking::route('/{record}'),
            'edit' => EditBooking::route('/{record}/edit'),
        ];
    }
}
