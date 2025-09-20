<div class="h-[100vh] flex justify-center items-center bg-gray-50">
    <div class="border border-gray-100 bg-white p-10 rounded-xl flex w-[480px] flex-col items-center justify-center">
        @if (session()->has('sent_email'))
            <div class="h-16 w-16 overflow-hidden">
                <img class="h-full w-full object-contain" src="https://cdn-icons-png.flaticon.com/512/8743/8743964.png"
                    alt="">
            </div>
            <h2 class="text-xl mt-5 font-bold font-['poppins']">Please verify your email</h2>
            <p class="text-gray-600 text-center mt-3">
                We just sent an email to <span class="font-semibold">{{ $this->email }}</span>. Click the link in the
                email to verify your account.
            </p>
            <form wire:submit.prevent="resendVerificationEmail()" class="flex justify-center mt-5">
                <button class="btn btn-primary">Resend email</button>
            </form>
        @else
            <div class="h-16 w-16 shadow-sm rounded-xl overflow-hidden">
                <img class="h-full w-full object-contain"
                    src="https://logosandtypes.com/wp-content/uploads/2022/03/Fxra.png" alt="">
            </div>
            <h2 class="text-2xl mt-5 font-bold font-['poppins']">Get Started !</h2>
            <p class="text-gray-600 text-center mt-3">Sign up to explore and book the best events around you.</p>
            <div class="w-full mt-5 space-y-2">
                <form class="space-y-2" wire:submit.prevent="handleFirstStep()">
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend text-sm">Full Name</legend>
                        <input type="text" class="input w-full h-12" placeholder="John Doe" wire:model="fullname" />
                        @error('fullname')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <fieldset class="fieldset w-full">
                        <legend class="fieldset-legend text-sm">Email</legend>
                        <input type="text" class="input w-full h-12" placeholder="john@doe.com" wire:model="email" />
                        @error('email')
                            <p class="label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <button class="btn btn-primary w-full h-12">Register</button>
                </form>
                <div class="divider text-gray-500 font-bold">OR</div>
                <button class="btn btn-secondary w-full h-12">
                    <div class="h-6 w-6">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/1200px-Google_%22G%22_logo.svg.png"
                            alt="" class="h-full w-full object-contain">
                    </div>
                    Continue with Google
                </button>
            </div>
        @endif
    </div>
</div>
</div>
