<div class="flex justify-center items-center pt-20 pb-20">
    <div class="bg-white/10 p-8 rounded-xl min-w-87.5">
        <div>
            <div class="flex justify-center mb-5">
                <label for="image"
                    class="h-18 w-18 rounded-full relative cursor-pointer bg-white/10 overflow-hidden group">
                    <img src="{{ $this->image ? $this->image->temporaryUrl() : 'https://variety.com/wp-content/uploads/2023/06/avatar-1.jpg?w=1000&h=563&crop=1' }}"
                        alt="" class="h-full w-full object-cover">
                    <div
                        class="absolute left-0 top-0 flex opacity-0 group-hover:opacity-100 duration-300 bg-black/50 justify-center items-center h-full w-full">
                        <x-heroicon-m-photo class="h-5 w-5" wire:loading.remove wire:target="image" />
                    </div>
                    <div class="absolute left-0 top-0 h-full w-full">
                        <div wire:loading.class="bg-black/50" wire:target="image"
                            class="flex justify-center items-center h-full w-full">
                            <span class="loading loading-sm" wire:loading="bg-black/50" wire:target="image"></span>
                        </div>
                    </div>
                </label>
                <input type="file" id="image" wire:model="image" hidden>
            </div>
            <h2 class="text-xl font-bold text-center">Setup Organizer</h2>
            <div class="mt-3 space-y-2">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Organizer Name</legend>
                    <input type="text" class="input" wire:model="name" placeholder="Tecno" />
                </fieldset>
                <div>
                    <button class="btn btn-primary w-full" wire:click="createOrganizer()">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>
