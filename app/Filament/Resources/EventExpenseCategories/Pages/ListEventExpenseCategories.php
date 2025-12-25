<?php

namespace App\Filament\Resources\EventExpenseCategories\Pages;

use App\Filament\Resources\EventExpenseCategories\EventExpenseCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;
use Guava\IconPicker\Forms\Components\IconPicker;

class ListEventExpenseCategories extends ListRecords
{
    protected static string $resource = EventExpenseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->schema([
                IconPicker::make('icon')
                    ->gridSearchResults()
                    ->required(),
                TextInput::make('name')
                    ->required()
            ])->slideOver()->modalWidth(Width::Large),
        ];
    }
}
