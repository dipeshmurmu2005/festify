<?php

namespace App\Filament\Organizer\Resources\FeaturedRequests;

use App\Filament\Organizer\Resources\FeaturedRequests\Pages\CreateFeaturedRequest;
use App\Filament\Organizer\Resources\FeaturedRequests\Pages\EditFeaturedRequest;
use App\Filament\Organizer\Resources\FeaturedRequests\Pages\ListFeaturedRequests;
use App\Filament\Organizer\Resources\FeaturedRequests\Pages\ViewFeaturedRequest;
use App\Filament\Organizer\Resources\FeaturedRequests\Schemas\FeaturedRequestForm;
use App\Filament\Organizer\Resources\FeaturedRequests\Schemas\FeaturedRequestInfolist;
use App\Filament\Organizer\Resources\FeaturedRequests\Tables\FeaturedRequestsTable;
use App\Models\FeaturedRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FeaturedRequestResource extends Resource
{
    protected static ?string $model = FeaturedRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Featured Lists';

    public static function form(Schema $schema): Schema
    {
        return FeaturedRequestForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FeaturedRequestInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeaturedRequestsTable::configure($table);
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
            'index' => ListFeaturedRequests::route('/'),
            'create' => CreateFeaturedRequest::route('/create'),
            'view' => ViewFeaturedRequest::route('/{record}'),
            'edit' => EditFeaturedRequest::route('/{record}/edit'),
        ];
    }
}
