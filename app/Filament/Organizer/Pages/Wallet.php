<?php

namespace App\Filament\Organizer\Pages;

use App\Actions\WithdrawalRequestAction;
use App\Filament\Organizer\Widgets\WalletStats;
use App\Models\WalletTransaction;
use App\Models\WithdrawalBank;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
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
        $wallet = auth()->user()->organizer->wallet;
        return [
            Action::make('Withdraw')->schema([
                Section::make()
                    ->heading(function () use ($wallet) {
                        return 'Balance : ' . $wallet->available_amount_for_withdrawal;
                    })
                    ->schema([
                        TextInput::make('amount')
                            ->label('Amount')
                            ->required()
                            ->numeric()
                            ->minValue(5000)
                            ->belowContent('Minimum Amount Rs. 5000'),
                    ]),
                Section::make('Bank Transfer')
                    ->description('Ensure your bank details are correct. Incorrect information may result in failed transfers, for which the platform is not responsible.')->schema([
                        TextInput::make('account_holder_name')
                            ->required()
                            ->label('Account Holder Name'),
                        TextInput::make('account_number')
                            ->required()
                            ->label('Account Number'),
                        Select::make('bank_name')
                            ->options(WithdrawalBank::pluck('name', 'name'))
                            ->native(false)
                            ->searchable()
                            ->required()
                            ->label('Bank Name')
                    ])
            ])
                ->action(function ($data) {
                    $withdrawalRequestAction = new WithdrawalRequestAction();
                    $withdrawalData = [
                        'amount' => $data['amount'],
                        'payment_details' => $data
                    ];
                    $response = $withdrawalRequestAction->createRequest($withdrawalData);
                    if ($response) {
                        Notification::make()
                            ->title('Withdrawal Request Successfull')
                            ->success()
                            ->send();
                    } else {
                        Notification::make()
                            ->title('Withdrawal Request Failed')
                            ->danger()
                            ->send();
                    }
                })
                ->disabled(function () use ($wallet) {

                    return $wallet->available_amount_for_withdrawal == 0;
                })
                ->requiresConfirmation()
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
                TextColumn::make('id')
                    ->label('Txn ID')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('transaction_uuid')
                    ->label('UUID')
                    ->copyable()
                    ->toggleable(),

                TextColumn::make('type')
                    ->badge()
                    ->sortable(),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->formatStateUsing(fn($state) => 'Rs. ' . number_format($state, 2))
                    ->weight('bold')
                    ->color(fn($record) => match ($record->type) {
                        'credit' => 'success',
                        'debit' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable(),

                TextColumn::make('source')
                    ->label('From')
                    ->description(fn($record) => $record->source_type->getLabel())
                    ->toggleable(),

                TextColumn::make('destination')
                    ->label('To')
                    ->description(fn($record) => $record->destination_type->getLabel())
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ]);
    }
}
