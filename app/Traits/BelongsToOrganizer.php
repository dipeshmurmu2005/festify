<?php

namespace App\Traits;

use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToOrganizer
{
    protected static function mutateFormDataBeforeCreate(array $data)
    {
        if (Filament::getTenant()) {
            $data['organizer_id'] = Filament::getTenant()->id;
            return $data;
        }
    }

    protected static function bootBelongsToOrganizer()
    {
        static::addGlobalScope('organizer', function ($query) {
            if (Filament::getTenant()) {
                $query->where('organizer_id', Filament::getTenant()->id);
            }
        });

        static::creating(function ($model) {
            if (Filament::getTenant()) {
                $model->organizer_id = Filament::getTenant()->id;
            }
        });

        static::updating(function ($model) {
            if (Filament::getTenant()) {
                $model->organizer_id = Filament::getTenant()->id;
            }
        });

        // static::addGlobalScope('latest', function (Builder $builder) {
        //     $builder->latest();
        // });
    }
}
