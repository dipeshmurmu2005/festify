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
                TextColumn::make('id')->label('Transaction ID'),
                TextColumn::make('type')->badge(),
                TextColumn::make('amount')->prefix('Rs. '),
            ])
            ->filters([
                //
            ])
            ->recordActions([]);
    }
}
