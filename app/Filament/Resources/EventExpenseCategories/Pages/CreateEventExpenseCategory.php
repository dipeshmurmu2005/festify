<?php

namespace App\Filament\Resources\EventExpenseCategories\Pages;

use App\Filament\Resources\EventExpenseCategories\EventExpenseCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEventExpenseCategory extends CreateRecord
{
    protected static string $resource = EventExpenseCategoryResource::class;
}
