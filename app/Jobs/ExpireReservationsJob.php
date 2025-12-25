<?php

namespace App\Jobs;

use App\Enums\TicketReservationStatusEnum;
use App\Models\TicketReservation;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ExpireReservationsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        TicketReservation::where('status', 'active')
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', Carbon::now())
            ->chunkById(100, function ($reservations) {
                foreach ($reservations as $reservation) {
                    $reservation->update([
                        'status' => 'expired',
                    ]);
                }
            });

        TicketReservation::where('status', TicketReservationStatusEnum::PAYMENT_INITIATED->value)
            ->whereNotNull('expires_at')
            ->where('expires_at', '<=', Carbon::now()->subMinute(1))
            ->chunkById(100, function ($reservations) {
                foreach ($reservations as $reservation) {
                    $reservation->update([
                        'status' => 'expired',
                    ]);
                }
            });
    }
}
