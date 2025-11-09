<?php

namespace App\Filament\Resources\KYCS;

use App\Filament\Resources\KYCS\Pages\CreateKYC;
use App\Filament\Resources\KYCS\Pages\EditKYC;
use App\Filament\Resources\KYCS\Pages\ListKYCS;
use App\Filament\Resources\KYCS\Pages\ViewKYC;
use App\Filament\Resources\KYCS\Schemas\KYCForm;
use App\Filament\Resources\KYCS\Schemas\KYCInfolist;
use App\Filament\Resources\KYCS\Tables\KYCSTable;
use App\Models\KYC;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KYCResource extends Resource
{
    protected static ?string $model = KYC::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'KYC';

    public static function form(Schema $schema): Schema
    {
        return KYCForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KYCInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KYCSTable::configure($table);
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
            'index' => ListKYCS::route('/'),
            'view' => ViewKYC::route('/{record}'),
        ];
    }
}
