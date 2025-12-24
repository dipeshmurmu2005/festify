<?php

namespace App\Filament\Organizer\Resources\WalletTransactions\Pages;

use App\Filament\Organizer\Resources\WalletTransactions\WalletTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWalletTransaction extends EditRecord
{
    protected static string $resource = WalletTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
