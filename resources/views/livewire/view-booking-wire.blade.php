<div class="px-5 py-5 pb-20">
    <div>
        <div class="border  border-white/5 bg-white/5 rounded-xl grid grid-cols-5 divide-x divide-white/5">
            <div class="flex gap-2 p-2">
                <div class="w-16 h-16 flex text-white/50 justify-center items-center text-xl bg-base-100 rounded-xl">
                    #
                </div>
                <div class="text-base font-bold flex flex-col justify-center">
                    <span class="text-sm">Booking Code</span>
                    <span class="font-semibold text-white/50">#{{ $this->booking->booking_code }}</span>
                </div>
            </div>
            <div class="flex gap-2 p-2">
                <div class="w-16 h-16 flex text-white/50 justify-center items-center bg-base-100 rounded-xl">
                    <x-icon name="{{ $this->booking->event->category->icon }}" class="h-6 w-6" />
                </div>
                <div class="text-base font-bold flex flex-col justify-center">
                    <span class="text-sm">Event</span>
                    <span class="font-semibold text-white/50">{{ $this->booking->event->title }}</span>
                </div>
            </div>
            <div class="flex gap-2 p-2">
                <div class="w-16 h-16 flex text-white/50 justify-center items-center bg-base-100 rounded-xl">
                    <x-heroicon-m-ticket class="h-6 w-6" />
                </div>
                <div class="text-base font-bold flex flex-col justify-center">
                    <span class="text-sm">Total Tickets</span>
                    <span class="font-semibold text-white/50">{{ $this->booking->tickets_count }}</span>
                </div>
            </div>
            <div class="flex gap-2 p-2">
                <div class="w-16 h-16 flex text-white/50 justify-center items-center bg-base-100 rounded-xl">
                    <x-heroicon-m-map-pin class="h-6 w-6" />
                </div>
                <div class="text-base font-bold flex flex-col justify-center">
                    <span class="text-sm">Venue</span>
                    <span class="font-semibold text-white/50">{{ $this->booking->event->venue_name }}</span>
                </div>
            </div>
            <div class="flex gap-2 p-2">
                <div class="w-16 h-16 flex text-white/50 justify-center items-center bg-base-100 rounded-xl">
                    <x-heroicon-m-map class="h-6 w-6" />
                </div>
                <div class="text-base font-bold flex flex-col justify-center">
                    <span class="text-sm">Venue Address</span>
                    <span class="font-semibold text-white/50">{{ $this->booking->event->venue_address }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-10">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-white">Tickets</h2>
            <button class="btn btn-primary" wire:click="downloadTickets()"><x-hugeicons-pdf-01 class="h-5 w-5" />
                Download</button>
        </div>
        <div class="grid grid-cols-4 mt-5 gap-10">
            @foreach ($this->booking->tickets as $ticket)
                <x-elements.booked-ticket :ticket="$ticket" />
            @endforeach
        </div>
    </div>
</div>
