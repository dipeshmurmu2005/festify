<?php

namespace App\Filament\Resources\WithdrawalRequests\Pages;

use App\Actions\WalletTransactionAction;
use App\Enums\WalletTransactionSourceAndDestinationTypeEnum;
use App\Enums\WithdrawalRequestEnum;
use App\Filament\Resources\WithdrawalRequests\WithdrawalRequestResource;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\Width;

class ViewWithdrawalRequest extends ViewRecord
{
    protected static string $resource = WithdrawalRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Approve')->action(function ($record) {
                $record->status = WithdrawalRequestEnum::Approved;
                $record->save();
            })
                ->disabled(fn($record) => $record->status != WithdrawalRequestEnum::Pending && $record->status != WithdrawalRequestEnum::Rejected)
                ->hidden(fn($record) => $record->status == WithdrawalRequestEnum::Paid)
                ->requiresConfirmation(),
            Action::make('Reject')->action(function ($record) {
                $record->status = WithdrawalRequestEnum::Rejected;
                $record->save();
            })->color('danger')
                ->hidden(fn($record) => $record->status == WithdrawalRequestEnum::Paid)
                ->disabled(fn($record) => $record->status == WithdrawalRequestEnum::Rejected)
                ->requiresConfirmation(),
            Action::make('Complete Payment')->schema([
                TextInput::make('transaction_uuid')
                    ->label('Transaction UUID')
                    ->required(),
                Select::make('source_type')->options(WalletTransactionSourceAndDestinationTypeEnum::class),
                TextInput::make('source')
                    ->label('Bank Name / Wallet Name')
                    ->required(),
                Textarea::make('description'),
            ])
                ->action(function ($record, $data) {
                    $walletAction = new WalletTransactionAction();
                    $transactionData = [
                        'organizer_id' => $record->organizer_id,
                        'source_type' => $data['source_type'],
                        'source' => $data['source'],
                        'destination_type' => WalletTransactionSourceAndDestinationTypeEnum::Bank,
                        'destination' => $record->payment_details['bank_name'],
                        'transaction_uuid' => $data['transaction_uuid'],
                        'amount' => $record->amount,
                        'notes' => 'Payment Created Successfully'
                    ];
                    $walletAction->debit($transactionData);
                    $record->status = WithdrawalRequestEnum::Paid;
                    $record->save();
                })
                ->modalWidth(Width::Small)
                ->visible(fn($record) => $record->status == WithdrawalRequestEnum::Approved)
        ];
    }
}
