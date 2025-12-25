<?php

namespace App\Livewire;

use App\Traits\BarCodeGenerator;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Url;
use Livewire\Component;
use Milon\Barcode\DNS1D;

class ViewBookingWire extends Component
{
    use BarCodeGenerator;
    #[Url()]
    public $booking_id;
    public $booking;

    public function mount()
    {
        $this->booking = auth()->user()->bookings()->withCount('tickets')->findOrFail($this->booking_id);
    }
    public function render()
    {
        return view('livewire.view-booking-wire');
    }

    public function downloadTickets()
    {
        return response()->streamDownload(function () {
            echo Pdf::loadView(
                'components.elements.booked-tickets',
                ['tickets' => $this->booking->tickets]
            )->setPaper('a6', 'portrait')->output();
        }, 'ticket.pdf');
    }
}
