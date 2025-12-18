<div class="flex justify-center items-center bg-center bg-cover pt-20">
    <div class="border border-white/10 bg-white/5 p-10 rounded-xl flex w-[480px] flex-col items-center justify-center">
        <div
            class="h-16 w-16 shadow-sm bg-white/10 rounded-xl overflow-hidden flex justify-center items-center font-astonish text-[3rem] pt-2 text-primary">
            F
        </div>
        <div class="text-xl 2xl:text-2xl mt-5 font-semibold">Welcome Back!</div>
        <p class="text-gray-600 text-center">Sign in to explore and book the best events around you.</p>
        <form wire:submit="login()" class="w-full">
            <div class="w-full mt-5 space-y-5">
                <fieldset class="fieldset w-full">
                    <legend class="fieldset-legend md:text-xs 2xl:text-sm">Email</legend>
                    <input type="text" class="input w-full h-12" wire:model="email" placeholder="john@doe.com" />
                    @error('email')
                        <p class="label text-error">{{ $message }}</p>
                    @enderror
                </fieldset>
                <div>
                    <x-elements.password model="password" />
                    <a href="#" class="flex justify-end mt-2 underline">Forgot Password ?</a>
                </div>
                <button class="btn btn-primary w-full h-12">Sign in</button>
            </div>
        </form>
    </div>
</div>
