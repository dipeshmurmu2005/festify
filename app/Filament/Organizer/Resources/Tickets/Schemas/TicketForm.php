<?php

namespace App\Filament\Organizer\Resources\Tickets\Schemas;

use App\Enums\TicketCapacityTypeEnum;
use App\Enums\TicketTypeEnum;
use App\Models\Event;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ToggleButtons::make('type')->options(TicketTypeEnum::class)->required()->default('paid')->live()->inline(),
                Select::make('event_id')->label('Event')->options(Event::pluck('title', 'id'))->disabled()->dehydrated(),
                TextInput::make('base_price')->label('Base Price')->numeric()->requiredIf('type', TicketTypeEnum::PAID->value)->hidden(fn($get) => $get('type') == TicketTypeEnum::FREE)->prefix('Rs '),
                TextInput::make('ticket_price')->dehydrated(false)->hidden(fn($get) => $get('type') == TicketTypeEnum::PAID)->disabled()->default('Free')->prefix('Rs '),
                TextInput::make('minimum_order_quantity')->required()->label('Minimum Order Quantity')->default(1),
                TextInput::make('maximum_order_quantity')->required()->label('Maximum Order Quantity')->default(10),
                Select::make('capacity_type')->required()->label('Capacity Type')->live()->default(function ($get) {
                    $event = Event::find($get('event_id'));
                    if ($event && $event->eventSessions->count() > 0 && $event->is_multi_session_event) {
                        return TicketCapacityTypeEnum::SHAREDWITHEVENT;
                    } else {
                        return TicketCapacityTypeEnum::SHAREDWITHEVENT;
                    }
                })->options(function ($get) {
                    $event = Event::find($get('event_id'));
                    if ($event) {
                        if (($event->is_multi_session_event && $event->eventSessions->count() == 0) || !$event->is_multi_session_event) {
                            return collect(TicketCapacityTypeEnum::cases())
                                ->reject(fn($case) => in_array($case, [
                                    TicketCapacityTypeEnum::SHAREDWITHSESSION,
                                ]))
                                ->mapWithKeys(fn($case) => [
                                    $case->value => $case->getLabel(),
                                ])
                                ->toArray();
                        } else {
                            return collect(TicketCapacityTypeEnum::cases())
                                ->mapWithKeys(fn($case) => [
                                    $case->value => $case->getLabel(),
                                ])
                                ->toArray();
                        }
                    } else {
                        return [];
                    }
                }),
                TextInput::make('capacity')
                    ->required()
                    ->label('Capacity')
                    ->requiredIf('capacity_type', TicketCapacityTypeEnum::INDIVIDUAL->value)
                    ->default(1)
                    ->hidden(
                        fn($get) =>
                        in_array($get('capacity_type'), [
                            TicketCapacityTypeEnum::SHAREDWITHSESSION->value,
                            TicketCapacityTypeEnum::SHAREDWITHEVENT->value,
                        ])
                    ),
                Repeater::make('aminities')->schema([
                    TextInput::make('title')
                ])->grid('4')->defaultItems(0)->columnSpanFull()->addActionAlignment(Alignment::Left)->addActionLabel('Add Aminities')->columnSpanFull(),
                Section::make('Sales Setting')->schema([
                    DateTimePicker::make('sales_starts_at')->maxDate(function ($get) {
                        $event = Event::find($get('event_id'));
                        return $event->end_date;
                    })->native(false)->required(),
                    DateTimePicker::make('sales_ends_at')->maxDate(function ($get) {
                        $event = Event::find($get('event_id'));
                        return $event->end_date;
                    })->native(false)->required(),
                ])->columns(2)->columnSpanFull()
            ]);
    }
}
