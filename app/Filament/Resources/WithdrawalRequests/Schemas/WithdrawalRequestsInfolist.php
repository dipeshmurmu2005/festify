<?php

namespace App\Filament\Resources\WithdrawalRequests\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WithdrawalRequestsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Request Information')
                    ->schema([
                        TextEntry::make('reference_no')
                            ->label('Reference ID')
                            ->copyable(),

                        TextEntry::make('organizer.name')
                            ->label('Requested By'),

                        TextEntry::make('currency'),

                        TextEntry::make('status')
                            ->badge()
                    ])
                    ->columns(2),

                Section::make('Financial Breakdown')
                    ->schema([
                        TextEntry::make('available_balance_at_request')
                            ->money(fn($record) => $record->currency)
                            ->label('Available Balance at Request'),

                        TextEntry::make('amount')
                            ->money(fn($record) => $record->currency),

                        TextEntry::make('platform_fee')
                            ->money(fn($record) => $record->currency),

                        TextEntry::make('processing_fee')
                            ->money(fn($record) => $record->currency),

                        TextEntry::make('net_amount')
                            ->money(fn($record) => $record->currency)
                            ->weight('bold'),
                    ])
                    ->columns(2),

                Section::make('Bank Details')
                    ->schema([
                        TextEntry::make('payment_method')
                            ->badge(),

                        TextEntry::make('payment_details.bank_name')
                            ->label('Bank Name'),

                        TextEntry::make('payment_details.account_holder_name')
                            ->label('Account Holder'),

                        TextEntry::make('payment_details.account_number')
                            ->label('Account Number')
                            ->copyable(),

                        TextEntry::make('payment_details.amount')
                            ->label('Requested Amount')
                            ->money(fn($record) => $record->currency),
                    ])
                    ->columns(2),

                Section::make('Status Timeline')
                    ->schema([
                        TextEntry::make('approved_by.name')
                            ->label('Approved By')
                            ->placeholder('-'),

                        TextEntry::make('approved_at')
                            ->dateTime()
                            ->placeholder('-'),

                        TextEntry::make('paid_at')
                            ->dateTime()
                            ->placeholder('-'),

                        TextEntry::make('cancelled_at')
                            ->dateTime()
                            ->placeholder('-'),

                        TextEntry::make('rejected_reason')
                            ->columnSpanFull()
                            ->placeholder('-'),
                    ])
                    ->columns(2),

                Section::make('System Information')
                    ->schema([
                        TextEntry::make('transaction_id')
                            ->copyable()
                            ->placeholder('-'),

                        TextEntry::make('ip_address')
                            ->placeholder('-'),

                        TextEntry::make('created_at')
                            ->dateTime(),

                        TextEntry::make('updated_at')
                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }
}
