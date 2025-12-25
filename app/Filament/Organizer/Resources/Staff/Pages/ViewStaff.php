<?php

namespace App\Filament\Organizer\Resources\Staff\Pages;

use App\Filament\Organizer\Resources\Staff\StaffResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStaff extends ViewRecord
{
    protected static string $resource = StaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
