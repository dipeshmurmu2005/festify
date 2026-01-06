<?php

namespace App\Filament\Resources\PlatformTransactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlatformTransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('initiator.name'),
                TextColumn::make('organizer.name'),
                TextColumn::make('beneficiary.name'),
                TextColumn::make('purpose')->badge(),
                TextColumn::make('type')->badge(),
                TextColumn::make('amount')->prefix('Rs. '),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
