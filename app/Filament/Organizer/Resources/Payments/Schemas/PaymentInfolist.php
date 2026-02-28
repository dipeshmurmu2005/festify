<?php

namespace App\Filament\Organizer\Resources\Payments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class PaymentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Transaction Overview')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('transaction_uuid')
                                    ->label('Transaction UUID')
                                    ->copyable()
                                    ->weight(FontWeight::Bold),

                                TextEntry::make('ref_id')
                                    ->label('Reference ID')
                                    ->copyable(),

                                TextEntry::make('status')
                                    ->badge()
                            ]),
                    ]),

                Section::make('Payment Details')
                    ->schema([
                        Grid::make(3)
                            ->schema([

                                TextEntry::make('amount')
                                    ->money('Rs. ')
                                    ->weight(FontWeight::Bold),

                                TextEntry::make('payment_method')
                                    ->badge(),

                                TextEntry::make('origin')
                                    ->badge()
                                    ->color('info'),
                            ]),
                    ]),

                Section::make('System Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([

                                TextEntry::make('created_at')
                                    ->dateTime(),

                                TextEntry::make('updated_at')
                                    ->dateTime(),
                            ]),
                    ]),
            ]);
    }
}
