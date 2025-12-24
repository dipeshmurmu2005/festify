<a href="#" class="swiper-slide cursor-pointer">
    <div class="space-y-2 group">
        <div class="rounded-2xl border-2 border-white/5 overflow-hidden relative h-95">
            <img src="{{ Storage::url($event->cover_image) }}" alt="" class="h-full w-full object-cover">
            <div class="absolute bottom-2 right-2">
                <div class="bg-black/90 px-5 py-2 text-primary font-black font-space text-sm rounded-full">
                    @if ($event->tickets_min_base_price > 0)
                        Rs. {{ $event->tickets_min_base_price ?? 0 }} -
                        {{ $event->tickets_max_base_price == $event->tickets_min_base_price ? 'Rs. ' . $event->tickets_max_base_price : null }}
                    @else
                        <span>No Tickets</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex gap-2 items-center">
            <div class="h-full w-fit bg-white/10 text-center px-3 py-2 rounded-md">
                <h3 class="font-semibold italic">{{ Carbon\Carbon::parse($event->event_date)->format('M') }}</h3>
                <h3 class="text-xl font-black font-space">{{ Carbon\Carbon::parse($event->event_date)->format('d') }}
                </h3>
            </div>
            <div>
                <h2 class="font-space font-bold text-lg group-hover:text-primary duration-300">{{ $event->title }}</h2>
                <p class="text-white/60">{{ $event->short_description }}</p>
            </div>
        </div>
    </div>
</a>
