<?php

namespace App\Filament\StaffPanel\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Scanner extends Page
{
    protected string $view = 'filament.staff-panel.pages.scanner';

    protected static string $layout  = 'components.layouts.clean';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::QrCode;

    public function getScripts(): array
    {
        return [];
    }

    public function getStyles(): array
    {
        return [];
    }

    public function findTicket($ticketid) {}
}
