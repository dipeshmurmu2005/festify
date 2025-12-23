<div class="grid grid-cols-10 gap-5 px-5 py-10">
    @foreach ($this->categories as $category)
        <a href="#">
            <div class="flex flex-col items-center space-y-3 group w-full text-center bg-white/5 p-5 h-full rounded-xl">
                <div
                    class="h-[70px] w-[70px] flex group-hover:bg-white/5 duration-300 justify-center items-center bg-black/10 rounded-xl text-white/50 group-hover:text-primary">
                    <x-icon name="{{ $category->icon }}" class="h-8 w-8" />
                </div>
                <h2 class="font-medium group-hover:text-primary duration-300 2xl:text-sm md:text-xs text-white/70">
                    {{ $category->name }}</h2>
            </div>
        </a>
    @endforeach
</div>
