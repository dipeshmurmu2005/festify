<?php

namespace App\Filament\Organizer\Resources\Tickets\Tables;

use App\Enums\TicketStatusEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('event.title'),
                TextColumn::make('base_price')->prefix('Rs '),
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
                    ->schema([
                        ToggleButtons::make('status')
                            ->options(TicketStatusEnum::class)
                            ->inline()
                    ])
                    ->action(function ($data, $record) {
                        $record->status = $data['status'];
                        $record->save();
                    })
                    ->slideOver()
                    ->modalWidth(Width::Large)
                    ->button(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
