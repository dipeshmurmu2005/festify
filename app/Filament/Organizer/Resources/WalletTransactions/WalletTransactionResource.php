<?php

namespace App\Filament\Organizer\Resources\WalletTransactions;

use App\Filament\Organizer\Resources\WalletTransactions\Pages\CreateWalletTransaction;
use App\Filament\Organizer\Resources\WalletTransactions\Pages\EditWalletTransaction;
use App\Filament\Organizer\Resources\WalletTransactions\Pages\ListWalletTransactions;
use App\Filament\Organizer\Resources\WalletTransactions\Schemas\WalletTransactionForm;
use App\Filament\Organizer\Resources\WalletTransactions\Tables\WalletTransactionsTable;
use App\Models\WalletTransaction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WalletTransactionResource extends Resource
{
    protected static ?string $model = WalletTransaction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Wallet;

    protected static ?string $recordTitleAttribute = 'Wallet Transaction';

    public static function form(Schema $schema): Schema
    {
        return WalletTransactionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WalletTransactionsTable::configure($table);
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
            'index' => ListWalletTransactions::route('/'),
        ];
    }
}
