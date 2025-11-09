<?php

namespace App\Filament\Resources\KYCS\Pages;

use App\Enums\KYCStatusEnum;
use App\Filament\Resources\KYCS\KYCResource;
use Filament\Actions\Action;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Enums\Alignment;

class ViewKYC extends ViewRecord
{
    protected static string $resource = KYCResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Change Status')->schema([
                ToggleButtons::make('status')->options(KYCStatusEnum::class)->hiddenLabel()->inline()->extraAttributes(['style' => 'justify-content:center;'])
            ])
                ->modalAlignment(Alignment::Center)
                ->fillForm(function ($record) {
                    return [
                        'status' => $record->status
                    ];
                })->action(function ($data, $record) {
                    $record->status = $data['status'];
                    $record->save();
                })
                ->requiresConfirmation(),
            Action::make('status')->label(function ($record) {
                return $record->status->getLabel();
            })->color(function ($record) {
                return $record->status->getColor();
            })->icon(function ($record) {
                return $record->status->getIcon();
            })
                ->disabled()
        ];
    }
}
