<?php

namespace App\Filament\Organizer\Resources\Events\Schemas;

use App\Enums\EventSessionTypeEnum;
use App\Enums\EventTypeEnum;
use App\Enums\VisibilityTypeEnum;
use App\Models\EventCategory;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Event Details')
                        ->schema([
                            Section::make('General Information')
                                ->description("Set up the core information for your event here.")
                                ->icon(Heroicon::InformationCircle)
                                ->iconSize('2xl')
                                ->schema([
                                    Grid::make('2')->schema([
                                        TextInput::make('title')
                                            ->required()
                                            ->placeholder('Enter the name of your Event'),
                                        TextInput::make('organizer_name')->label('Organizer Name')
                                            ->required()
                                            ->default(function () {
                                                return auth()->user()->organizer->name;
                                            })
                                    ]),
                                    Grid::make('2')
                                        ->schema([
                                            Select::make('visibility_type')
                                                ->label('Visibility Type')
                                                ->options(VisibilityTypeEnum::class),
                                            Select::make('event_category_id')
                                                ->label('Category')
                                                ->options(EventCategory::pluck('name', 'id'))
                                        ]),
                                    RichEditor::make('short_description')
                                        ->label('Short Description')
                                        ->required()
                                        ->placeholder('Tell attendees about your event'),
                                    RichEditor::make('long_description')
                                        ->label('Long Description')
                                        ->required()
                                        ->placeholder('Tell attendees about your event'),
                                    FileUpload::make('cover_image')
                                        ->columnSpanFull()
                                        ->required()
                                ])->columns(2),
                        ]),
                    Step::make('Venue & Location')->schema([
                        Section::make('Venue Details')
                            ->icon(Heroicon::Cog8Tooth)
                            ->schema([
                                TextInput::make('venue_name')
                                    ->label('Venue Name')
                                    ->required(),
                                TextInput::make('venue_address')
                                    ->label('Address')
                                    ->required(),
                                TextInput::make('venue_capacity_override')
                                    ->label('General Admission (GA) Capacity')
                                    ->required()
                            ])->columns(5),
                        Section::make('GPS (Location)')
                            ->icon(Heroicon::Map)
                            ->schema([
                                TextInput::make('venue_latitude')
                                    ->label('Latitude'),
                                TextInput::make('venue_longitude')
                                    ->label('Longitude')
                            ])->columns(5)
                    ]),
                    Step::make('Event Type & Schedule')->schema([
                        Section::make('Schedule')
                            ->icon(Heroicon::Calendar)
                            ->description("Manage your event’s type and timing here.")
                            ->schema([
                                ToggleButtons::make('schedule_type')
                                    ->live()
                                    ->default(EventTypeEnum::SingleDay)
                                    ->label('Schedule Type')
                                    ->required()
                                    ->options(EventTypeEnum::class)->inline(),
                                Grid::make('1')->schema([
                                    DatePicker::make('event_date')->label('Event Date')
                                        ->dehydratedWhenHidden(true)
                                        ->native(false)
                                        ->live()
                                        ->prefixIcon('heroicon-o-calendar')
                                        ->required()
                                        ->hidden(fn($get) => $get('schedule_type') == EventTypeEnum::RecurringEvent),
                                    DatePicker::make('end_date')->label('Event Ends At')
                                        ->dehydratedWhenHidden(true)
                                        ->native(false)
                                        ->live()
                                        ->prefixIcon('heroicon-o-calendar')
                                        ->requiredIf('schedule_type', ['across days', 'across days full package'])
                                        ->hidden(fn($get) => $get('schedule_type') == EventTypeEnum::RecurringEvent || $get('schedule_type') == EventTypeEnum::SingleDay)
                                ])->columns(3)
                            ]),
                        Toggle::make('is_multi_session_event')->label('Has Multiple Booking Sessions')->live(),
                        Section::make('Sessions')
                            ->icon(Heroicon::Clock)
                            ->description('Create and manage individual sessions for your event, including their timing, speakers, and capacity.')
                            ->schema([
                                ToggleButtons::make('session_type')->default(EventSessionTypeEnum::DAY_SPECIFIC)->dehydrated(false)->live()->options(EventSessionTypeEnum::class)->inline(),

                                Repeater::make('sessions')->relationship('eventSessions')->schema([
                                    DatePicker::make('date')
                                        ->minDate(fn($get) => Carbon::parse($get('../../event_date')))
                                        ->maxDate(fn($get) => Carbon::parse($get('../../end_date')))
                                        ->native(false)
                                        ->prefixIcon('heroicon-o-calendar')
                                        ->hidden(fn($get) => $get('../../session_type') == EventSessionTypeEnum::EVERY_DAY),
                                    TimePicker::make('time')
                                        ->prefixIcon('heroicon-o-clock'),
                                    TextInput::make('ticket_adjustment')
                                        ->label('Ticket Price Adjustment')
                                        ->prefix('+/-'),
                                    TextInput::make('capacity_override')
                                        ->label('Capacity Overrides'),
                                    TextInput::make('label')
                                        ->label('Label')
                                        ->placeholder('Workshop'),
                                ])
                                    ->columns(5)
                                    ->live()
                                    ->addActionAlignment(Alignment::Start)
                                    ->defaultItems(0)
                                    ->addActionLabel('Create Session')
                            ])->visible(fn($get) => $get('is_multi_session_event'))
                    ]),
                    // Step::make('Publish Settings')->schema([
                    //     Section::make('SEO')->schema([
                    //         TextInput::make('seo_title'),
                    //         TextInput::make('meta_description'),
                    //         Grid::make(2)->schema([
                    //             Select::make('keywords')->label('Keywords/Tags'),
                    //             Select::make('visibility')->options(VisibilityTypeEnum::class)
                    //         ])
                    //     ])
                    // ])
                ])->columnSpanFull()
                    ->nextAction(function (Action $action) {
                        return $action
                            ->label('Next')
                            ->button()
                            ->color('primary');
                    })->previousAction(function (Action $action) {
                        return $action
                            ->label('Back')
                            ->button()
                            ->color('gray');
                    })->submitAction(new HtmlString(Blade::render(<<<BLADE
                                    <x-filament::button
                                        type="submit"
                                        size="sm"
                                    >
                                    Submit
                                        </x-filament::button>
                                    BLADE)))
                    ->persistStepInQueryString()
            ]);
    }
}
