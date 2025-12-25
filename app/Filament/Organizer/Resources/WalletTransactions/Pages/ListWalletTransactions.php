<?php

namespace App\Filament\Organizer\Resources\WalletTransactions\Pages;

use App\Filament\Organizer\Resources\WalletTransactions\WalletTransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWalletTransactions extends ListRecords
{
    protected static string $resource = WalletTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
