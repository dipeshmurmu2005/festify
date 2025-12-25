<?php

namespace App\Filament\Organizer\Resources\Bookings\Schemas;

use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class BookingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Information')->schema([
                    TextEntry::make('user.name')->label('Name')->size(TextSize::Large),
                    TextEntry::make('user.email')->label('Email')->size(TextSize::Large),
                ])->columnSpanFull()->columns(3),
                Section::make('Booking Information')->schema([
                    TextEntry::make('event.title')->label('Event')->size(TextSize::Large),
                    TextEntry::make('booking_code')->label('Booking Code')->size(TextSize::Large),
                    TextEntry::make('tickets_count')->default(function ($record) {
                        return $record->tickets->count();
                    })->label('Tickets Count')->size(TextSize::Large),
                ])->columnSpanFull()->columns(3),
                Section::make('Tickets Information')->schema([
                    RepeatableEntry::make('tickets')
                        ->table([
                            TableColumn::make('Title'),
                            TableColumn::make('Ticket Code'),
                            TableColumn::make('Event Date'),
                        ])
                        ->columnSpanFull()
                        ->schema([
                            TextEntry::make('ticket.title'),
                            TextEntry::make('ticket_code'),
                            TextEntry::make('event_date'),
                        ])

                ])->columnSpanFull()->columns(3)
            ]);
    }
}
