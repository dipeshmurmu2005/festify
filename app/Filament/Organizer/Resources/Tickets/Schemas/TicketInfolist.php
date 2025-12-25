<?php

namespace App\Filament\Organizer\Resources\Tickets\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ticket Information')->schema([
                    TextEntry::make('title')->size(TextSize::Large),
                    TextEntry::make('base_price')->size(TextSize::Large)->prefix('Rs. '),
                    TextEntry::make('type')->size(TextSize::Large)->badge(),
                    TextEntry::make('event.title')->label('Event')->size(TextSize::Large),
                    TextEntry::make('capacity_type')->badge(),
                    TextEntry::make('status')->badge()
                ])->columns(3)->columnSpanFull(),
                Section::make('Sale Information')->schema([
                    TextEntry::make('sales_starts_at')->size(TextSize::Large),
                    TextEntry::make('sales_ends_at')->size(TextSize::Large)->prefix('Rs. '),
                ])->columns(3)->columnSpanFull()
            ]);
    }
}
