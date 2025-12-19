<?php

namespace App\Filament\Organizer\Resources\Payments\Tables;

use App\Enums\PaymentStatusEnum;
use App\Models\Booking;
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
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('event.title'),
                TextColumn::make('reservation.reservation_code'),
                TextColumn::make('user.name'),
                TextColumn::make('payer_id')->label('Payer Id'),
                TextColumn::make('payment_method')->badge(),
                TextColumn::make('token'),
                TextColumn::make('amount')->prefix('Rs. '),
                TextColumn::make('status')->badge(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('Change Status')
                    ->fillForm(function ($record) {
                        return [
                            'status' => $record->status
                        ];
                    })
                    ->button()
                    ->schema([
                        ToggleButtons::make('status')->options(PaymentStatusEnum::class)->inline()
                    ])
                    ->action(function ($data, $record) {
                        $record->status = $data['status'];
                        if ($record->status == PaymentStatusEnum::Verified) {
                            Booking::create([
                                'user_id' => $record->user_id,
                                'event_id' => $record->event_id,
                                'reservation_id' => $record->reservation_id
                            ]);
                        }
                        $record->save();
                    })
                    ->slideOver()
                    ->modalWidth(Width::Large)
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
