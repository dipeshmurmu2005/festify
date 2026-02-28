<?php

namespace App\Filament\Organizer\Resources\Payments\Tables;

use App\Enums\PaymentStatusEnum;
use App\Models\Booking;
use App\Traits\BookingCodeGenerator;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\ToggleButtons;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentsTable
{
    use BookingCodeGenerator;

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('event.title'),
                TextColumn::make('reservation.reservation_code'),
                TextColumn::make('transaction_uuid')->label('Transaction UUID'),
                TextColumn::make('ref_id')->label('REF ID'),
                TextColumn::make('user.name'),
                TextColumn::make('payment_method')->badge(),
                TextColumn::make('amount')->prefix('Rs. '),
                TextColumn::make('status')->badge(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
