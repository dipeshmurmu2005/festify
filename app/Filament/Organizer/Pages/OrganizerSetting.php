<?php

namespace App\Filament\Organizer\Pages;

use App\Models\OrganizerSetting as ModelsOrganizerSetting;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;

class OrganizerSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.organizer.pages.organizer-setting';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog6Tooth;

    public function getMaxContentWidth(): Width
    {
        return Width::FiveExtraLarge;
    }

    public $name;

    public $email;

    public $website;

    public $phone;

    public $logo;

    public function mount(): void
    {
        $setting = auth()->user()->organizer->settings;
        $this->form->fill([
            'logo' => $setting ? $setting->logo : null,
            'name' =>  $setting ? $setting->name  : auth()->user()->name,
            'email' => $setting ? $setting->email  : auth()->user()->email,
            'website' => $setting ? $setting->website : null,
            'phone' => $setting ? $setting->phone : null
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Basic Information')->schema([
                FileUpload::make('logo')->avatar()->maxFiles(1)->columnSpanFull(),
                TextInput::make('name')
                    ->label('Display Name'),
                TextInput::make('email')->label('Email')->placeholder('john@doe.com'),
                TextInput::make('phone')->label('Phone')->mask('9999999999'),
                TextInput::make('website')->prefix('https://'),
            ])->columns(3),
        ];
    }

    public function create()
    {
        $data = $this->form->getState();
        ModelsOrganizerSetting::updateOrCreate(
            ['organizer_id' => auth()->user()->organizer->id],
            $data
        );
        Notification::make()
            ->title('Setting Updated Successfully')
            ->success()
            ->send();
    }
}
