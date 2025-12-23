<div>
    <x-home.banner />
    <x-home.categories />
    <livewire:trending-events-wire />
    <livewire:upcoming-events-wire />
    <div class="relative h-[700px]">
        <video src="{{ asset('images/usingfestifyf.mp4') }}" autoplay muted loop
            class="h-full w-full object-cover"></video>
        <div class="h-full w-full absolute left-0 top-0 bg-black/90 flex items-center px-5">
            <div class="grid grid-cols-5 gap-20">
                <div class="col-span-2 space-y-10">
                    <div class="w-fit px-5 py-3 bg-primary/10 rounded-full border border-primary/50 text-primary">For
                        Organizers
                    </div>
                    <h2 class="text-5xl font-semibold tracking-tight leading-snug text-white/90">Seamlessly create,
                        promote manage your
                        Events</h2>
                    <p class="text-white/50 text-lg">Festify is the modern and intuitive way to model, plan, Lorem,
                        ipsum dolor
                        sit amet consectetur
                        adipisicing elit. Modi, dignissimos tenetur veniam esse quo commodi nam in ipsa assumenda non.
                        and
                        align your business for everyone on your
                        team </p>
                    <div class="flex gap-4 text-lg">
                        <a href="{{ route('organizer.overview') }}">
                            <button class="btn h-16 px-8 btn-primary rounded-xl">Start Promoting Now</button>
                        </a>
                        <button class="btn h-16 px-8 btn-info btn-outline rounded-xl">View Demo</button>
                    </div>
                </div>
                <div class="col-span-3 flex items-center">
                    <div class="grid grid-cols-3 w-full divide-x divide-white/50">
                        <div class="flex flex-col items-center font-space justify-center gap-2 text-center h-fit">
                            <span class="text-6xl font-bold italic">10M +</span>
                            <span class="text-3xl font-semibold text-primary">Organizers</span>
                        </div>
                        <div class="flex flex-col items-center font-space justify-center gap-2 text-center h-fit">
                            <span class="text-6xl font-bold italic">50K +</span>
                            <span class="text-3xl font-semibold text-primary">Users</span>
                        </div>
                        <div class="flex flex-col items-center font-space justify-center gap-2 text-center h-fit">
                            <span class="text-6xl font-bold italic">100M +</span>
                            <span class="text-3xl font-semibold text-primary">Tickets Sold</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="px-46 pb-20">
        <div class="mb-10 flex gap-5">
            <h2 class="font-semibold w-fit border-b-3 border-primary text-primary pb-2 cursor-pointer ">All</h2>
            <h2 class="font-semibold w-fit border-b-3 border-transparent cursor-pointer pb-2">Today</h2>
        </div>

        <div class="grid grid-cols-4 md:gap-5 2xl:gap-10">
            @foreach ($this->events as $event)
                <x-elements.event :id="$event->id" />
            @endforeach
        </div>
        <div class="mt-10 flex justify-center">
            <button class="btn btn-primary btn-outline rounded-full">Load More</button>
        </div>
    </div> --}}
</div>
