<?php

namespace App\Filament\Organizer\Resources\Events;

use App\Filament\Organizer\Resources\Events\Pages\CreateEvent;
use App\Filament\Organizer\Resources\Events\Pages\EditEvent;
use App\Filament\Organizer\Resources\Events\Pages\ListEvents;
use App\Filament\Organizer\Resources\Events\Pages\ViewEvent;
use App\Filament\Organizer\Resources\Events\RelationManagers\ExpensesRelationManager;
use App\Filament\Organizer\Resources\Events\RelationManagers\TicketsRelationManager;
use App\Filament\Organizer\Resources\Events\Schemas\EventForm;
use App\Filament\Organizer\Resources\Events\Schemas\EventInfolist;
use App\Filament\Organizer\Resources\Events\Tables\EventsTable;
use App\Models\Event;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDateRange;

    protected static ?string $recordTitleAttribute = 'event';

    public static function form(Schema $schema): Schema
    {
        return EventForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EventInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $query->where('user_id', auth()->id());

        return $query;
    }

    public static function getRelations(): array
    {
        return [
            TicketsRelationManager::class,
            ExpensesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEvents::route('/'),
            'create' => CreateEvent::route('/create'),
            'view' => ViewEvent::route('/{record}'),
            'edit' => EditEvent::route('/{record}/edit'),
        ];
    }
}
