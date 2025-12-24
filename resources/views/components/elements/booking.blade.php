<a href="{{ route('user.booking.view', ['booking_id' => $booking->id]) }}">
    <div class="rounded-xl border-2 border-white/5">
        <div class="overflow-hidden rounded-xl relative text-black">
            <div class="absolute left-0 top-0 h-full w-full bg-white">

            </div>
            <div class="p-10 relative z-10 space-y-5">
                <div>
                    <h2 class="font-semibold">{{ $booking->event->category->name }}</h2>
                    <h3 class="text-2xl font-bold">{{ $booking->event->title }}</h3>
                    <h4 class="text-black/50 font-semibold">{{ $booking->event->venue_name }}</h4>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <h2 class="font-semibold text-black/50">Booking Refrence</h2>
                        <h3 class="text-lg font-bold">#{{ $booking->booking_code }}</h3>
                    </div>
                    <div>
                        <h2 class="font-semibold text-black/50">Event Date</h2>
                        <h3 class="text-lg font-bold">
                            {{ Carbon\Carbon::parse($booking->event->event_date)->format('d M, Y') }}</h3>
                    </div>
                </div>
                <div class="pt-5 border-t border-dashed">
                    <div class="grid grid-cols-2">
                        <div>
                            <h2 class="font-semibold text-black/50">Total Tickets</h2>
                            <h3 class="text-xl font-bold text-space">
                                {{ $booking->tickets_count }}</h3>
                        </div>
                        <div class="flex justify-end items-center w-full">
                            <span
                                class="px-4 py-2 bg-success text-black font-bold border border-success rounded-full">Booked</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
