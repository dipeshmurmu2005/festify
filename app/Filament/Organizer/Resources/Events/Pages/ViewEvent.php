<?php

namespace App\Filament\Organizer\Resources\Events\Pages;

use App\Enums\EventStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\TicketCapacityTypeEnum;
use App\Enums\TicketTypeEnum;
use App\Filament\Organizer\Resources\Events\EventResource;
use App\Models\EventExpenseCategory;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;

class ViewEvent extends ViewRecord
{
    protected static string $resource = EventResource::class;


    public function getTitle(): string|Htmlable
    {
        return $this->record->title;
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->icon(Heroicon::PencilSquare),
            Action::make('Create Tickets')
                ->icon(Heroicon::Ticket)
                ->schema([
                    Section::make('Tickets')
                        ->icon(Heroicon::Ticket)
                        ->description("Set up ticket types, prices, and availability for your event.")
                        ->schema([
                            ToggleButtons::make('type')->options(TicketTypeEnum::class)->required()->default('paid')->live()->inline(),
                            Section::make('Ticket')->schema([
                                TextInput::make('title')->columnSpan(2)->required(),
                                TextInput::make('base_price')->label('Base Price')->numeric()->requiredIf('type', TicketTypeEnum::PAID->value)->hidden(fn($get) => $get('type') == TicketTypeEnum::FREE)->prefix('Rs '),
                                TextInput::make('ticket_price')->dehydrated(false)->hidden(fn($get) => $get('type') == TicketTypeEnum::PAID)->disabled()->default('Free')->prefix('Rs '),
                                TextInput::make('minimum_order_quantity')->required()->label('Minimum Order Quantity')->default(1),
                                TextInput::make('maximum_order_quantity')->required()->label('Maximum Order Quantity')->default(10),
                                Select::make('capacity_type')->required()->label('Capacity Type')->live()->default(function ($get, $record) {
                                    if ($record->eventSessions->count() > 0 && $record->is_multi_session_event) {
                                        return TicketCapacityTypeEnum::SHAREDWITHEVENT;
                                    } else {
                                        return TicketCapacityTypeEnum::SHAREDWITHEVENT;
                                    }
                                })->options(function ($get, $record) {
                                    if (($record->is_multi_session_event && $record->eventSessions->count() == 0) || !$record->is_multi_session_event) {
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
                                }),
                                TextInput::make('capacity')
                                    ->required()
                                    ->label('Capacity')
                                    ->requiredIf('capacity_type', TicketCapacityTypeEnum::INDIVIDUAL->value)
                                    ->default(1)
                                    ->hidden(fn($get) => $get('capacity_type') == TicketCapacityTypeEnum::SHAREDWITHSESSION),
                                Repeater::make('aminities')->schema([
                                    TextInput::make('title')
                                ])->grid('4')->defaultItems(0)->columnSpanFull()->addActionAlignment(Alignment::Left)->addActionLabel('Add Aminities')->columnSpanFull(),
                                Section::make('Sales Setting')->schema([
                                    DateTimePicker::make('sales_starts_at')->native(false)->required(),
                                    DateTimePicker::make('sales_ends_at')->native(false)->required(),
                                ])->columns(2)->columnSpanFull()
                            ])->columns(4),
                        ])
                ])
                ->action(function (array $data, $record): void {
                    $finalData = Arr::except($data, ['ticket_price']);
                    $record->tickets()->create($finalData);
                })
                ->color('success')
                ->slideOver()->modalWidth(Width::FiveExtraLarge),


            Action::make('Publish')
                ->icon(function ($record) {
                    if ($record->status == EventStatusEnum::Published) {
                        return Heroicon::PaperClip;
                    } else {
                        return Heroicon::PaperAirplane;
                    }
                })
                ->label(function ($record) {
                    if ($record->status == EventStatusEnum::Published) {
                        return 'Change to Draft';
                    } else {
                        return 'Publish';
                    }
                })
                ->color(function ($record) {
                    if ($record->status == EventStatusEnum::Published) {
                        return 'danger';
                    } else {
                        return 'success';
                    }
                })
                ->requiresConfirmation()->action(function ($record) {
                    if ($record->status == EventStatusEnum::Published) {
                        $record->status = EventStatusEnum::Draft;
                    } else {
                        $record->status = EventStatusEnum::Published;
                    }
                    $record->save();
                }),
            Action::make('Cancel Event')->action(function ($record) {
                $record->status = EventStatusEnum::Cancelled;
                $record->save();
            })
                ->requiresConfirmation()
                ->color('danger')
                ->icon(Heroicon::XCircle)
                ->disabled(function ($record) {
                    return $record->status == EventStatusEnum::Cancelled;
                }),
            Action::make('Add Expenses')->schema([
                Repeater::make('expenses')->schema([
                    TextInput::make('title'),
                    Select::make('expense_category_id')->required()->label('Expense Category')->options(EventExpenseCategory::pluck('name', 'id')),
                    TextInput::make('notes')->required()->columnSpanFull(),
                    TextInput::make('payee_name')->required()->label('Vendor / Payee Name'),
                    TextInput::make('amount')->required()->prefix('NPR'),
                    Select::make('payment_status')->required()->label('Payment Status')->live()->options(PaymentStatusEnum::class),
                    DatePicker::make('payment_date')->hidden(fn($get) => $get('payment_status') == PaymentStatusEnum::Pending || $get('payment_status') == null),
                ])->columns(2)
            ])->action(function ($data, $record) {
                $record->expenses()->createMany($data['expenses']);
                Notification::make()
                    ->success()
                    ->title('Successfully Created Expense');
            })
        ];
    }
}
