<div>
    <x-home.banner />
    <x-home.categories />
    <div class="px-46 pb-20">
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
    </div>
</div>
