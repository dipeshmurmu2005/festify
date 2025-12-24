<?php

namespace App\Filament\Organizer\Resources\FeaturedRequests\Pages;

use App\Filament\Organizer\Resources\FeaturedRequests\FeaturedRequestResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFeaturedRequest extends ViewRecord
{
    protected static string $resource = FeaturedRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
