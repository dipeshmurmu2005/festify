<?php

namespace App\Filament\Resources\PlatformTransactions\Pages;

use App\Filament\Resources\PlatformTransactions\PlatformTransactionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPlatformTransaction extends ViewRecord
{
    protected static string $resource = PlatformTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
