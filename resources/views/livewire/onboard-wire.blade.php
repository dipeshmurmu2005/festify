<div class="py-20">
    <div class="flex justify-center items-center">
        <div>
            <div class="mb-5">
                <button class="btn btn-outline btn-primary rounded-full" wire:click="goBack()"><x-heroicon-m-arrow-left
                        class="h-5 w-5" />
                    Go Back</button>
            </div>
            <div
                class="border border-white/10 bg-white/5 p-10 rounded-xl flex w-[480px] flex-col items-center justify-center">
                <div class="w-full mt-5 space-y-5">
                    <form wire:submit.prevent="completeSetup()" class="space-y-5">
                        <div>
                            <x-elements.password label="New Password" model="password" />
                        </div>
                        <div>
                            <x-elements.password label="Confirm Password" model="password_confirmation" />
                        </div>
                        <button class="btn btn-primary h-12 w-full">Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
