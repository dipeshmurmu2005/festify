<?php

namespace App\Filament\Organizer\Resources\Events\Schemas;

use Carbon\Carbon;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Event Details')->schema([
                    TextEntry::make('schedule_type')->label('Schedule Type'),
                    TextEntry::make('event_date')->formatStateUsing(function ($record) {
                        return Carbon::parse($record->event_date)->format('d M, Y') . ' ' . '-' . ' ' . Carbon::parse($record->event_date)->format('d M, Y');
                    }),
                    TextEntry::make('venue_name')->label('Venue'),
                    TextEntry::make('venue_address')->label('Venue Location'),
                    TextEntry::make('venue_capacity_override')->label('Venue Capacity'),
                    TextEntry::make('gross_ticket_revenue')->label('Gross Ticket Revenue')->prefix('Rs ')->default('0.00')->label('Revenue'),
                    TextEntry::make('status')->badge()
                ])->columns(7)->columnSpanFull(),
                Section::make('Event Sessions')->schema([
                    RepeatableEntry::make('eventSessions')->schema([
                        TextEntry::make('label'),
                        TextEntry::make('time'),
                        TextEntry::make('date')->default('No Date'),
                        TextEntry::make('capacity_override'),
                        TextEntry::make('ticket_adjustment'),
                    ])->columns(5)->columnSpanFull()->hiddenLabel()
                ])->columnSpanFull(),
            ]);
    }
}
