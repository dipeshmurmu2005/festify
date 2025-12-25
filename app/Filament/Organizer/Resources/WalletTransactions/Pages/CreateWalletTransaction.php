<?php

namespace App\Filament\Organizer\Resources\WalletTransactions\Pages;

use App\Filament\Organizer\Resources\WalletTransactions\WalletTransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWalletTransaction extends CreateRecord
{
    protected static string $resource = WalletTransactionResource::class;
}
