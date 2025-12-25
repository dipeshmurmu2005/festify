<?php

namespace App\Filament\Resources\PlatformTransactions\Pages;

use App\Filament\Resources\PlatformTransactions\PlatformTransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPlatformTransaction extends EditRecord
{
    protected static string $resource = PlatformTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
