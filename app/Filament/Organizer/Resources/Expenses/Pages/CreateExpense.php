<?php

namespace App\Filament\Organizer\Resources\Expenses\Pages;

use App\Filament\Organizer\Resources\Expenses\ExpenseResource;
use Filament\Resources\Pages\CreateRecord;

class CreateExpense extends CreateRecord
{
    protected static string $resource = ExpenseResource::class;
}
