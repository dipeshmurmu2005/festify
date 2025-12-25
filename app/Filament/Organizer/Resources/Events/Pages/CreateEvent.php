<?php

namespace App\Filament\Organizer\Resources\Events\Pages;

use App\Filament\Organizer\Resources\Events\EventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            $this->getCreateFormAction()->formId('form')
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }
}
