<?php

namespace App\Filament\Resources\EventCategories\Pages;

use App\Filament\Resources\EventCategories\EventCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;
use Guava\IconPicker\Forms\Components\IconPicker;

class ListEventCategories extends ListRecords
{
    protected static string $resource = EventCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->schema([
                IconPicker::make('icon')
                    ->gridSearchResults()
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                Toggle::make('is_new')->label('Is New Category')
                    ->required(),
            ])->slideOver()->modalWidth(Width::Large),
        ];
    }
}
