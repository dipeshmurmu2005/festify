<?php

namespace App\Filament\Organizer\Resources\FeaturedRequests\Pages;

use App\Filament\Organizer\Resources\FeaturedRequests\FeaturedRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFeaturedRequests extends ListRecords
{
    protected static string $resource = FeaturedRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
