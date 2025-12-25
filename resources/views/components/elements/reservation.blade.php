<a href="{{ route('view.reservation', ['reservation_id' => $reservation->id]) }}">
    <div class="rounded-xl border-2 border-white/5">
        <div class="overflow-hidden rounded-xl relative text-black">
            <div class="absolute left-0 top-0 h-full w-full bg-white">

            </div>
            <div class="p-10 relative z-10 space-y-5">
                <div>
                    <h2 class="font-semibold bg-success text-black w-fit px-4 py-2 mb-2">
                        {{ $reservation->event->category->name }}</h2>
                    <h3 class="text-2xl font-bold">{{ $reservation->event->title }}</h3>
                    <h4 class="text-black/50 font-semibold">{{ $reservation->event->venue_name }}</h4>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <h2 class="font-semibold text-black/50">Reservation Refrence</h2>
                        <h3 class="text-lg font-bold">#{{ $reservation->reservation_code }}</h3>
                    </div>
                    <div>
                        <h2 class="font-semibold text-black/50">Event Date</h2>
                        <h3 class="text-lg font-bold">
                            {{ Carbon\Carbon::parse($reservation->event->event_date)->format('d M, Y') }}</h3>
                    </div>
                </div>
                <div class="pt-5 border-t border-dashed">
                    <div class="grid grid-cols-3">
                        <div>
                            <h2 class="font-semibold text-black/50">Total Tickets</h2>
                            <h3 class="text-xl font-bold text-space">
                                {{ $reservation->reserved_tickets_sum_quantity }}</h3>
                        </div>
                        <div>
                            <h2 class="font-semibold text-black/50">Total Amount</h2>
                            <h3 class="text-xl font-bold text-space">Rs. {{ $reservation->total_amount }}
                            </h3>
                        </div>
                        <div>
                            <h2 class="font-semibold text-black/50">Expiry</h2>
                            <div>
                                @if ($reservation->status->value != 'expired' && $reservation->status->value == 'active')
                                    @php
                                        $diffInSeconds = abs(
                                            Carbon\Carbon::parse($reservation->expires_at)->diffInSeconds(),
                                        );
                                    @endphp

                                    <span class="font-semibold text-lg">
                                        <div x-data="{
                                            totalSeconds: {{ $diffInSeconds }},
                                            interval: null,
                                            init() {
                                                this.start();
                                            },
                                            start() {
                                                if (this.totalSeconds <= 0) return;
                                        
                                                this.interval = setInterval(() => {
                                                    if (this.totalSeconds > 0) {
                                                        this.totalSeconds--;
                                                    } else {
                                                        clearInterval(this.interval);
                                                    }
                                                }, 1000);
                                            },
                                        
                                            get formattedTime() {
                                                const mins = Math.floor(this.totalSeconds / 60);
                                                const secs = this.totalSeconds % 60;
                                        
                                                return {
                                                    mins: mins,
                                                    secs: parseInt(secs)
                                                }
                                            }
                                        }">
                                            <span x-text="formattedTime.mins"></span>
                                            <span class="text-xs text-black/50">Mins</span>
                                            <span x-text="formattedTime.secs"></span>
                                            <span class="text-xs text-black/50">Secs</span>
                                        </div>
                                    </span>
                                @elseif($reservation->status->value == 'expired')
                                    <div class="mt-2">
                                        <span
                                            class="mt-2 bg-warning w-fit px-4 py-2 text-xs rounded-full border border-warning">Expired</span>
                                    </div>
                                @elseif($reservation->status->value == 'payment done')
                                    <div class="mt-2">
                                        <span
                                            class="mt-2 bg-success w-fit px-4 py-2 text-xs rounded-full border border-success">Converted</span>
                                    </div>
                                @elseif($reservation->status->value == 'cancelled')
                                    <div class="mt-2">
                                        <span
                                            class="mt-2 bg-error w-fit px-4 py-2 text-xs rounded-full border border-error text-white">Cancelled</span>
                                    </div>
                                @elseif ($reservation->is_expired)
                                    <div class="mt-2">
                                        <span
                                            class="mt-2 bg-warning/10 w-fit px-4 py-2 text-xs text-warning rounded-full border border-warning">About
                                            to Expire</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
