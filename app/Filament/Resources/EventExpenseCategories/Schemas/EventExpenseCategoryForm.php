<?php

namespace App\Filament\Resources\EventExpenseCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EventExpenseCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
            ]);
    }
}
