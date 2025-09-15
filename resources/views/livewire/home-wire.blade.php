<div>
    <x-home.banner />
    <x-home.categories />
    <div class="2xl:px-46 pb-20">
        <div class="mb-10 flex gap-5">
            <h2 class="font-semibold w-fit border-b-3 border-primary text-primary pb-2 cursor-pointer ">All</h2>
            <h2 class="font-semibold w-fit border-b-3 border-transparent cursor-pointer pb-2">Today</h2>
        </div>

        <div class="grid grid-cols-4 gap-10">
            <x-elements.event />
            <x-elements.event />
            <x-elements.event />
            <x-elements.event />
        </div>
        <div class="mt-10 flex justify-center">
            <button class="btn btn-primary btn-outline rounded-full">Load More</button>
        </div>
    </div>
</div>
