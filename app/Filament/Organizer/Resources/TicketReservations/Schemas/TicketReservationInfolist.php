<?php

namespace App\Filament\Organizer\Resources\TicketReservations\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\RepeatableEntry\TableColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TicketReservationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Reserved Tickets')->schema([
                    RepeatableEntry::make('reservedTickets')
                        ->table([
                            TableColumn::make('Name'),
                            TableColumn::make('Base Price'),
                            TableColumn::make('Quantity'),
                            TableColumn::make('Total'),
                        ])
                        ->schema([
                            TextEntry::make('ticket.title'),
                            TextEntry::make('base_price'),
                            TextEntry::make('quantity'),
                            TextEntry::make('total')->getStateUsing(function ($record, $get) {
                                return $get('base_price') * $get('quantity');
                            })->prefix('Rs. '),
                        ])->columns(5)
                        ->hiddenLabel(),
                    Section::make('Order Summary')->schema([
                        TextEntry::make('total_amount')->prefix('Rs. ')
                    ]),
                    Section::make('Customer Details')->schema([
                        TextEntry::make('customer.name'),
                        TextEntry::make('customer.email'),
                        TextEntry::make('customer.phone')
                    ])->columns(3)
                ]),
                Grid::make(1)->schema([
                    Section::make('Reservation Details')->schema([
                        TextEntry::make('status')->badge(),
                        TextEntry::make('created_at'),
                        TextEntry::make('expires_at')->color('danger')
                    ])->columns(3),
                    Section::make('Event Details')->schema([
                        TextEntry::make('event.title'),
                        TextEntry::make('eventSession.label'),
                        TextEntry::make('Date & Time')->label(function ($record) {
                            return $record->eventSession ? 'Session Date & Time' : 'Event Date & Time';
                        })->getStateUsing(function ($record, $get) {
                            return $record->eventSession ? $record->eventSession->time : $record->event->event_date;
                        })
                    ])->columns(3),
                ])
            ]);
    }
}
