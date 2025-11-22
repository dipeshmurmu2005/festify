<?php

namespace App\Filament\Resources\EventExpenseCategories;

use App\Filament\Resources\EventExpenseCategories\Pages\CreateEventExpenseCategory;
use App\Filament\Resources\EventExpenseCategories\Pages\EditEventExpenseCategory;
use App\Filament\Resources\EventExpenseCategories\Pages\ListEventExpenseCategories;
use App\Filament\Resources\EventExpenseCategories\Pages\ViewEventExpenseCategory;
use App\Filament\Resources\EventExpenseCategories\Schemas\EventExpenseCategoryForm;
use App\Filament\Resources\EventExpenseCategories\Schemas\EventExpenseCategoryInfolist;
use App\Filament\Resources\EventExpenseCategories\Tables\EventExpenseCategoriesTable;
use App\Models\EventExpenseCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EventExpenseCategoryResource extends Resource
{
    protected static ?string $model = EventExpenseCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'expense-category';

    public static function form(Schema $schema): Schema
    {
        return EventExpenseCategoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EventExpenseCategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventExpenseCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEventExpenseCategories::route('/'),
            'view' => ViewEventExpenseCategory::route('/{record}'),
        ];
    }
}
