<?php

namespace App\Filament\Organizer\Resources\WalletTransactions\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WalletTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Txn ID')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('transaction_uuid')
                    ->label('UUID')
                    ->copyable()
                    ->toggleable(),

                TextColumn::make('type')
                    ->badge()
                    ->sortable(),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->formatStateUsing(fn($state) => 'Rs. ' . number_format($state, 2))
                    ->weight('bold')
                    ->color(fn($record) => match ($record->type) {
                        'credit' => 'success',
                        'debit' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable(),

                TextColumn::make('source')
                    ->label('From')
                    ->description(fn($record) => $record->source_type->getLabel())
                    ->toggleable(),

                TextColumn::make('destination')
                    ->label('To')
                    ->description(fn($record) => $record->destination_type->getLabel())
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([]);
    }
}
