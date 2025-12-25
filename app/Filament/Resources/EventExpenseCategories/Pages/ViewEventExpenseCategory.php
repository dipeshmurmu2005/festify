<?php

namespace App\Filament\Resources\EventExpenseCategories\Pages;

use App\Filament\Resources\EventExpenseCategories\EventExpenseCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEventExpenseCategory extends ViewRecord
{
    protected static string $resource = EventExpenseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
