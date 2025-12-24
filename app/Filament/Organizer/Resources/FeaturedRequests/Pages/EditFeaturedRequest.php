<?php

namespace App\Filament\Organizer\Resources\FeaturedRequests\Pages;

use App\Filament\Organizer\Resources\FeaturedRequests\FeaturedRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFeaturedRequest extends EditRecord
{
    protected static string $resource = FeaturedRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
