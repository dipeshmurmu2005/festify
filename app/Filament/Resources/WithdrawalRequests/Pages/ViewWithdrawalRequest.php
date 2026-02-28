<?php

namespace App\Filament\Resources\WithdrawalRequests\Pages;

use App\Enums\WithdrawalRequestEnum;
use App\Filament\Resources\WithdrawalRequests\WithdrawalRequestResource;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;

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
                ->requiresConfirmation(),
            Action::make('Reject')->action(function ($record) {
                $record->status = WithdrawalRequestEnum::Rejected;
                $record->save();
            })->color('danger')
                ->disabled(fn($record) => $record->status == WithdrawalRequestEnum::Rejected)
                ->requiresConfirmation(),
            Action::make('Complete Payment')->schema([
                TextInput::make('transaction_id')->label('Transaction ID')
            ])
        ];
    }
}
