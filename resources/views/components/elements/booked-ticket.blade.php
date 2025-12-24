<div class="bg-white p-10 rounded-xl text-black">
    <div class="space-y-5 mb-10">
        <div>
            <h2 class="font-semibold text-black/50">Ticket Number</h2>
            <h3 class="font-semibold text-lg">#{{ $ticket->ticket_code }}</h3>
        </div>
        <div>
            <h2 class="text-4xl font-bold">{{ $ticket->event->title }}</h2>
        </div>
        <div class="grid grid-cols-2 gap-5">
            <div>
                <div>Ticket Type</div>
                <div class="font-semibold text-lg">{{ $ticket->ticket->title }}</div>
            </div>
            <div>
                <div>Booked By</div>
                <div class="font-semibold text-lg">{{ $ticket->user->name }}</div>
            </div>
            <div>
                <div>Event Date</div>
                <div class="font-semibold text-lg">{{ Carbon\Carbon::parse($ticket->event_date)->format('d M, Y') }}
                </div>
            </div>
        </div>
    </div>
    <div class="relative flex justify-between items-center">
        <div class="absolute -left-20 h-20 w-20 bg-base-100 rounded-full"></div>
        <div class="border border-dashed border-black w-full"></div>
        <div class="absolute -right-20 h-20 w-20 bg-base-100 rounded-full"></div>
    </div>
    <div class="flex justify-center items-center pt-20">
        <div class="h-16">
            <img src="data:image/png;base64,{{ $ticket->bar_code }}" class="w-full h-full object-contain">
        </div>
    </div>
</div>
