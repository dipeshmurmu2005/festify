<?php

namespace App\Filament\Resources\PlatformTransactions;

use App\Filament\Resources\PlatformTransactions\Pages\CreatePlatformTransaction;
use App\Filament\Resources\PlatformTransactions\Pages\EditPlatformTransaction;
use App\Filament\Resources\PlatformTransactions\Pages\ListPlatformTransactions;
use App\Filament\Resources\PlatformTransactions\Pages\ViewPlatformTransaction;
use App\Filament\Resources\PlatformTransactions\Schemas\PlatformTransactionForm;
use App\Filament\Resources\PlatformTransactions\Schemas\PlatformTransactionInfolist;
use App\Filament\Resources\PlatformTransactions\Tables\PlatformTransactionsTable;
use App\Models\PlatformTransaction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PlatformTransactionResource extends Resource
{
    protected static ?string $model = PlatformTransaction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Platform Transaction';

    public static function form(Schema $schema): Schema
    {
        return PlatformTransactionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PlatformTransactionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PlatformTransactionsTable::configure($table);
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
            'index' => ListPlatformTransactions::route('/'),
            'create' => CreatePlatformTransaction::route('/create'),
            'view' => ViewPlatformTransaction::route('/{record}'),
            'edit' => EditPlatformTransaction::route('/{record}/edit'),
        ];
    }
}
