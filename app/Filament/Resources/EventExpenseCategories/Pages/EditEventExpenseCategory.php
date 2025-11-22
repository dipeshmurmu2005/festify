<?php

namespace App\Filament\Resources\EventExpenseCategories\Pages;

use App\Filament\Resources\EventExpenseCategories\EventExpenseCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditEventExpenseCategory extends EditRecord
{
    protected static string $resource = EventExpenseCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
