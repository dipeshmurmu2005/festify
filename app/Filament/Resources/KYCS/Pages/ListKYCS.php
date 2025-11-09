<?php

namespace App\Filament\Resources\KYCS\Pages;

use App\Filament\Resources\KYCS\KYCResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKYCS extends ListRecords
{
    protected static string $resource = KYCResource::class;
}
