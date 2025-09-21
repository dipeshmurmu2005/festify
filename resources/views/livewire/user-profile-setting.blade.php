<div>
    <div>
        <h2 class="font-bold text-lg">Personal Details</h2>
        <p class="text-gray-600">Update your info and find out how it's used.</p>
    </div>
    <div class="mt-5">
        <div class="flex gap-2 items-center">
            <div class="h-16 w-16 rounded-full overflow-hidden relative group cursor-pointer">
                <img src="https://cdn.pixabay.com/photo/2022/03/11/06/14/indian-man-7061278_640.jpg" alt=""
                    class="h-full w-full object-cover">
                <div
                    class="absolute bg-[rgba(0,0,0,0.5)] -bottom-[100%] group-hover:bottom-0 duration-300  w-full flex justify-center px-3 py-2 text-white">
                    <x-heroicon-o-camera class="h-5 w-5" />
                </div>
            </div>
            <div @click.outside="enable=false" x-data="{
                enable: @entangle('userprofile'),
            }">
                <template x-if="!enable">
                    <div class="flex gap-2 items-center">
                        <h2 class="font-semibold">{{ $this->name }}</h2> <button
                            class="btn btn-ghost btn-circle text-primary btn-sm"
                            @click="enable=true"><x-hugeicons-pen-01 class="h-5 w-5" /></button>
                    </div>
                </template>
                <template x-if="enable">
                    <form wire:submit.prevent="updateDisplayName()">
                        <input type="text" value="Dipesh Murmu" class="border-b font-semibold" wire:model="name">
                        <button class="btn btn-ghost btn-circle btn-sm border border-gray-200">
                            <span class="loading loading-spinner loading-xs" wire:loading
                                wire:target="updateDisplayName"></span>
                            <x-heroicon-o-check-circle class="h-5 w-5" wire:loading.remove
                                wire:target="updateDisplayName()" /></button>
                    </form>
                </template>
                <p class="text-xs flex gap-1 text-gray-600 font-medium"><x-heroicon-o-information-circle
                        class="h-4 w-4" /> Display
                    Name</p>
            </div>
        </div>
    </div>
</div>
