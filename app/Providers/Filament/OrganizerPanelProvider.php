<?php

namespace App\Providers\Filament;

use App\Http\Middleware\AuthenticateOrganizer;
use App\Models\Organizer;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class OrganizerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('organizer')
            ->path('organizer')
            ->tenant(Organizer::class)
            ->darkMode()
            ->colors([
                'primary' => Color::Green,
            ])
            ->topNavigation()
            ->globalSearch(false)
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Reservations & Bookings')
                    ->icon(Heroicon::CalendarDateRange),
                NavigationGroup::make()
                    ->label('Billings')
                    ->icon(Heroicon::CurrencyRupee),
            ])
            ->maxContentWidth(Width::Full)
            ->discoverResources(in: app_path('Filament/Organizer/Resources'), for: 'App\Filament\Organizer\Resources')
            ->discoverPages(in: app_path('Filament/Organizer/Pages'), for: 'App\Filament\Organizer\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Organizer/Widgets'), for: 'App\Filament\Organizer\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                AuthenticateOrganizer::class
            ]);
    }
}
