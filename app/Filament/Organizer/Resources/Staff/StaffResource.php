<?php

namespace App\Filament\Organizer\Resources\Staff;

use App\Filament\Organizer\Resources\Staff\Pages\CreateStaff;
use App\Filament\Organizer\Resources\Staff\Pages\EditStaff;
use App\Filament\Organizer\Resources\Staff\Pages\ListStaff;
use App\Filament\Organizer\Resources\Staff\Pages\ViewStaff;
use App\Filament\Organizer\Resources\Staff\Schemas\StaffForm;
use App\Filament\Organizer\Resources\Staff\Schemas\StaffInfolist;
use App\Filament\Organizer\Resources\Staff\Tables\StaffTable;
use App\Models\Staff;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $recordTitleAttribute = 'staff';

    public static function form(Schema $schema): Schema
    {
        return StaffForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StaffInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StaffTable::configure($table);
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
            'index' => ListStaff::route('/'),
            'view' => ViewStaff::route('/{record}'),
        ];
    }
}
