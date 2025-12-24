<?php

namespace App\Filament\Organizer\Resources\FeaturedRequests\Pages;

use App\Filament\Organizer\Resources\FeaturedRequests\FeaturedRequestResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFeaturedRequest extends CreateRecord
{
    protected static string $resource = FeaturedRequestResource::class;
}
