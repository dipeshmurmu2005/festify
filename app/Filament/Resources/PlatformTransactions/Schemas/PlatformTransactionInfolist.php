<?php

namespace App\Filament\Resources\PlatformTransactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;

class PlatformTransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Transaction Overview')
                    ->schema([
                        Grid::make(3)
                            ->schema([

                                TextEntry::make('type')
                                    ->badge(),

                                TextEntry::make('status')
                                    ->badge(),

                                TextEntry::make('amount')
                                    ->money('NPR')
                                    ->weight(FontWeight::Bold),
                                TextEntry::make('notes')->columnSpanFull(),
                                TextEntry::make('created_at')->dateTime(),
                                TextEntry::make('updated_at')->dateTime(),
                            ]),
                    ]),

                Section::make('Participants')
                    ->schema([
                        Grid::make(2)
                            ->schema([

                                TextEntry::make('initiator_type')
                                    ->label('Initiated By')
                                    ->badge(),

                                TextEntry::make('initiator_id')
                                    ->label('Initiator ID'),

                                TextEntry::make('beneficiary_type')
                                    ->label('Beneficiary Type')
                                    ->badge(),

                                TextEntry::make('beneficiary_id')
                                    ->label('Beneficiary ID'),

                                TextEntry::make('organizer.name')
                                    ->label('Organizer')
                                    ->visible(fn($record) => filled($record->organizer_id)),
                            ]),
                    ]),

                Section::make('Linked Payment')
                    ->schema([
                        Grid::make(3)
                            ->schema([

                                TextEntry::make('payment.transaction_uuid')
                                    ->label('Transaction UUID')
                                    ->copyable(),

                                TextEntry::make('payment.ref_id')
                                    ->label('Reference ID')
                                    ->copyable(),

                                TextEntry::make('payment.payment_method')
                                    ->label('Payment Method')
                                    ->badge(),

                                TextEntry::make('payment.amount')
                                    ->label('Payment Amount')
                                    ->money('NPR'),

                                TextEntry::make('payment.event.title')
                                    ->label('Event'),

                                TextEntry::make('payment.reservation_id')
                                    ->label('Reservation ID')
                                    ->prefix('#'),

                                TextEntry::make('payment.user.name')
                                    ->label('Customer'),

                                TextEntry::make('payment.origin')
                                    ->label('Payment Origin')
                                    ->badge(),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->visible(fn($record) => filled($record->payment_id)),
                Section::make('Reference & Purpose')
                    ->schema([
                        Grid::make(2)
                            ->schema([

                                TextEntry::make('purpose'),

                                TextEntry::make('origin')
                                    ->badge(),

                                TextEntry::make('referenceable_type')
                                    ->label('Reference Type')
                                    ->badge(),

                                TextEntry::make('referenceable_id')
                                    ->label('Reference ID'),
                            ]),
                    ]),
            ]);
    }
}
