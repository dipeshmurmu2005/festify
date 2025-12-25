<?php

namespace App\Filament\Organizer\Resources\Bookings\Pages;

use App\Filament\Organizer\Resources\Bookings\BookingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\Support\Htmlable;

class ViewBooking extends ViewRecord
{
    protected static string $resource = BookingResource::class;

    public function getMaxContentWidth(): Width
    {
        return Width::FiveExtraLarge;
    }

    public function getTitle(): string|Htmlable
    {
        return 'Booking #' . $this->record->booking_code;
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
