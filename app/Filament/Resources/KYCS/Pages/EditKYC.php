<?php

namespace App\Filament\Resources\KYCS\Pages;

use App\Filament\Resources\KYCS\KYCResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditKYC extends EditRecord
{
    protected static string $resource = KYCResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
