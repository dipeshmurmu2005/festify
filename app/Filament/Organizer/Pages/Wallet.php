<?php

namespace App\Filament\Organizer\Pages;

use App\Filament\Organizer\Widgets\WalletStats;
use App\Models\WalletTransaction;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Wallet extends Page implements HasTable
{
    use InteractsWithTable;
    protected string $view = 'filament.organizer.pages.wallet';

    protected function getHeaderWidgets(): array
    {
        return [
            WalletStats::class
        ];
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function getWallet()
    {
        return auth()->user()->organizer->wallet;
    }

    public static function table(Table $table): Table
    {
        return $table->query(WalletTransaction::query()
            ->where('wallet_id', auth()->user()->organizer->wallet->id)
            ->latest())
            ->columns([
                TextColumn::make('id')->label('Transaction ID'),
                TextColumn::make('type')->badge(),
                TextColumn::make('amount')->prefix('Rs. '),
            ]);
    }
}
