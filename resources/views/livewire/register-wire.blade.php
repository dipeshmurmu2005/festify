<div class="relative">
    <div class="absolute left-0 top-0 h-full w-full opacity-5">
        <img src="https://cdn.gabb.com/wp-content/uploads/2025/10/kids-jumping-gabb.png" alt=""
            class="h-full w-full object-cover">
    </div>
    <div class="relative z-30">
        @if ($this->mail_sent)
            <div class="flex justify-center items-center h-screen">
                <div class="rounded-xl flex flex-col w-[280px] items-center justify-center">
                    <h2 class="text-xl mb-2 font-black">Check your inbox</h2>
                    <p class="text-white/50 text-center">
                        We have sent an activation link to <span
                            class="font-semibold">{{ $this->email ?? session('email') }}</span>. Please be sure to check
                        your
                        spam folder too.
                    </p>
                    <div class="flex justify-center mt-5 gap-2">
                        <button class="btn btn-primary" @click="resendVerificationEmail()">Resend email</button>
                        <button class="btn btn-neutral" type="button" wire:click="useDifferentEmail()">Use
                            Different Email</button>
                    </div>
                </div>
            </div>
        @else
            <div class="flex justify-center items-center h-screen">
                <div class="space-y-5">
                    <div class="flex justify-center">
                        <div
                            class="font-astonish text-5xl flex justify-center items-center pt-2 text-primary h-16 w-16 rounded-md bg-white/10">
                            F
                        </div>
                    </div>
                    <div class="text-center font-black text-2xl">
                        <div>Welcome to Festify</div>
                        <div class="text-white/50">Start Exploring Now</div>
                    </div>
                    <form class="space-y-2 w-full" wire:submit.prevent="handleFirstStep()">
                        <fieldset class="fieldset w-[280px]">
                            <input type="text" class="input w-full h-10" placeholder="Full Name"
                                wire:model="fullname" />
                            @error('fullname')
                                <p class="label text-error">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <fieldset class="fieldset w-[280px]">
                            <input type="text" class="input w-full h-10" placeholder="john@doe.com"
                                wire:model="email" />
                            @error('email')
                                <p class="label text-error">{{ $message }}</p>
                            @enderror
                        </fieldset>
                        <button class="btn btn-primary w-full h-10">Register</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
