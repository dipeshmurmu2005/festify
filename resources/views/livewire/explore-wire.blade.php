<div>
    <div class="px-5 flex justify-between py-5 border-b border-white/5 sticky top-0 bg-base-100 z-50">
        <div class="bg-white/5 rounded-xl border border-white/10 p-2 w-fit">
            <form wire:submit="search()" class="flex gap-2 h-full">
                <div class="flex gap-2 h-full border-r-2 border-white/10">
                    <div class="h-10 w-10 flex justify-center items-center text-white/50">
                        <x-heroicon-m-magnifying-glass class="h-4 w-4" />
                    </div>
                    <input type="text" class="bg-transparent! h-10 w-98" wire:model="search_query"
                        placeholder="Search here...">
                </div>
                <div class="flex divide-x-2 divide-white/10 pl-8">
                    <div class="flex gap-2 items-center">
                        <div>
                            <div
                                class="h-8 w-8 font-bold flex justify-center items-center bg-white/5 rounded-md text-lg">
                                रु
                            </div>
                        </div> <span>Min Price</span>
                        <input type="text" wire:model="min_price" class="bg-transparent! h-10 w-32 font-semibold"
                            placeholder="0">
                    </div>
                    <div class="flex gap-2 items-center pl-8">
                        <div>
                            <div
                                class="h-8 w-8 font-bold flex justify-center items-center bg-white/5 rounded-md text-lg">
                                रु
                            </div>
                        </div> <span>Max Price</span>
                        <input type="text" wire:model="max_price" class="bg-transparent! h-10 w-32 font-semibold"
                            placeholder="0">
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary h-10 px-5">Search</button>
                </div>
            </form>
        </div>
        <div class="bg-white/5 h-fit p-2 rounded-xl border border-white/10 flex gap-2">
            <button class="bg-white/10 border-white/10 rounded-md px-8 text-white/90 btn">Events</button>
            <button class="btn bg-transparent border-transparent rounded-md px-8 text-white/50">Organizers</button>
        </div>
    </div>
    <div class="grid grid-cols-4 gap-20 px-5 py-5 pb-20">
        <div class="h-fit sticky top-32 space-y-10">
            <div class="space-y-3">
                <h2 class="font-semibold text-lg">Categories</h2>
                <div class="space-y-3" x-data="{
                    selected_categories: @entangle('selected_categories').live,
                    setCategory(newcategory) {
                        var findCategory = this.selected_categories.findIndex((category) => category == newcategory);
                        if (findCategory >= 0) {
                            this.selected_categories.splice(findCategory, 1);
                        } else {
                            this.selected_categories.push(newcategory);
                        }
                    },
                    isSelected(newcategory) {
                        return this.selected_categories.some((category) => category == newcategory);
                    }
                }">
                    @foreach ($this->categories as $category)
                        <div class="flex cursor-pointer gap-2 items-center text-white/50"
                            @click="setCategory({{ $category->id }})">
                            <input type="checkbox" :checked="isSelected({{ $category->id }})"
                                class="checkbox checkbox-square" />
                            <span>{{ $category->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="space-y-3">
                <h2 class="font-semibold text-lg">Dates</h2>
                <div class="grid grid-cols-2 gap-5">
                    <button
                        class="btn {{ $this->date_filter_type == 'today' ? 'btn-primary' : 'btn-neutral' }} h-12 rounded-lg"
                        wire:click="setDateFilter('today')">Today</button>
                    <button
                        class="btn {{ $this->date_filter_type == 'tomorrow' ? 'btn-primary' : 'btn-neutral' }} h-12 rounded-lg"
                        wire:click="setDateFilter('tomorrow')">Tomorrow</button>
                    <button
                        class="btn {{ $this->date_filter_type == 'this week' ? 'btn-primary' : 'btn-neutral' }} h-12 rounded-lg"
                        wire:click="setDateFilter('this week')">This
                        Weekend</button>
                    <button
                        class="btn {{ $this->date_filter_type == 'next week' ? 'btn-primary' : 'btn-neutral' }} h-12 rounded-lg"
                        wire:click="setDateFilter('next week')">Next
                        Week</button>
                </div>
            </div>
        </div>
        <div class="col-span-3">
            <div class="flex justify-between items-center pb-5">
                {{-- <div class="flex gap-5 items-center">
                    <span class="font-semibold text-white/50">Active Filters</span>
                    <div>
                        <div
                            class="bg-white/5 px-8 py-3 flex gap-2 items-center rounded-full font-semibold text-white/80">
                            Music Festivals
                            <button class="btn btn-sm btn-circle btn-neutral"><x-heroicon-m-x-mark
                                    class="h-4 w-4" /></button>
                        </div>
                    </div>
                </div> --}}
                <div>
                    <select class="select" wire:model.live="sort">
                        <option>Relevence</option>
                        @foreach ($this->sort_filters as $sort)
                            <option value="{{ $sort->value }}">{{ $sort->getLabel() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-5">
                @foreach ($this->events as $event)
                    <x-elements.event :event="$event" />
                @endforeach
            </div>
        </div>
    </div>
</div>
