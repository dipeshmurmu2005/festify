<?php

namespace App\Filament\Organizer\Resources\Payments\Pages;

use App\Filament\Organizer\Resources\Payments\PaymentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPayments extends ListRecords
{
    protected static string $resource = PaymentResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
