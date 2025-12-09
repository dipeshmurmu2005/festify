<?php

namespace App\Filament\StaffPanel\Pages;

use Filament\Pages\Page;

class Scanner extends Page
{
    protected string $view = 'filament.staff-panel.pages.scanner';

    protected static string $layout  = 'components.layouts.clean';

    public function getScripts(): array
    {
        return [];
    }

    public function getStyles(): array
    {
        return [];
    }
}
