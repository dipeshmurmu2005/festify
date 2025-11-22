<?php

namespace App\Filament\Resources\EventExpenseCategories\Pages;

use App\Filament\Resources\EventExpenseCategories\EventExpenseCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEventExpenseCategories extends ListRecords
{
    protected static string $resource = EventExpenseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
