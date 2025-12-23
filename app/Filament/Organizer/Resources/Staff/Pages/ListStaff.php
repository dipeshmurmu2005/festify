<?php

namespace App\Filament\Organizer\Resources\Staff\Pages;

use App\Filament\Organizer\Resources\Staff\StaffResource;
use App\Models\Staff;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;

class ListStaff extends ListRecords
{
    protected static string $resource = StaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')
                    ->required()
                    ->autocomplete(false)
                    ->email(),
                TextInput::make('password')
                    ->required()
                    ->password()
                    ->autocomplete(false)
            ])->action(function ($data) {
                $staff = auth()->user()->organizer->staff()->create([
                    'organizer_id' => auth('organizer')->user(),
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password']
                ]);
            })->slideOver()->modalWidth(Width::Large),
        ];
    }
}
