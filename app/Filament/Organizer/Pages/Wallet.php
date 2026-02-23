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
        return [
            Action::make('Withdraw')->schema([
                TextInput::make('amount')->label('Amount')->belowContent('Minimum Amount Rs. 5000'),
                Section::make('Bank Transfer')
                    ->description('Ensure your bank details are correct. Incorrect information may result in failed transfers, for which the platform is not responsible.')->schema([
                        TextInput::make('account_holder_name')->label('Account Holder Name'),
                        TextInput::make('account_number')->label('Account Number'),
                        TextInput::make('bank_name')->label('Bank Name')
                    ])
            ])
                ->action(function () {})
                ->slideOver()
                ->modalSubmitActionLabel('Confirm Withdrawl')
                ->modalWidth(Width::Large)
        ];
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
