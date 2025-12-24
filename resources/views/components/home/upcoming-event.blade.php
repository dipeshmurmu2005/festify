<a href="{{ route('event.view', ['event' => $event->id]) }}" class="swiper-slide cursor-pointer group">
    <div class="p-5 flex gap-2 bg-white/5 rounded-xl">
        <div>
            <div class="h-20 w-20 font-space italic bg-cover bg-white/10 overflow-hidden rounded-xl flex justify-center items-center flex-col"
                style="background-image:url('{{ Storage::url($event->cover_image) }}')">
                <div class="flex justify-center items-center flex-col bg-black/50 h-full w-full">
                    <span
                        class="text-primary font-semibold">{{ Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                    <span class="font-bold text-2xl">{{ Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                </div>
            </div>
        </div>
        <div>
            <h3 class="font-bold text-lg text-primary">{{ $event->title }}</h3>
            <p class="text-white/60 line-clamp-2">{{ $event->short_description }}</p>
            <div class="mt-5">
                <button class="btn btn-sm btn-info btn-outline">Learn More <x-heroicon-m-chevron-right
                        class="h-5 w-5" /></button>
            </div>
        </div>
    </div>
</a>
