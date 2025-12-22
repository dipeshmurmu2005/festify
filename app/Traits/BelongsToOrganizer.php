<?php

namespace App\Traits;

use Filament\Facades\Filament;

trait BelongsToOrganizer
{
    protected static function mutateFormDataBeforeCreate(array $data): array
    {
        if (Filament::getTenant()) {
            $data['organizer_id'] = Filament::getTenant()->id;
        }
    }

    protected static function bootBelongsToOrganizer()
    {
        static::addGlobalScope('organizer', function ($query) {
            if (Filament::getTenant()) {
                $query->where('organizer_id', Filament::getTenant()->id);
            }
        });
    }
}
