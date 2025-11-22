<div
    class="h-[100vh] flex justify-center items-center bg-center bg-cover bg-[url('https://wallpapercat.com/w/full/3/3/1/1161176-3840x2160-desktop-4k-concert-background-photo.jpg')]">
    <div class="border border-gray-100 bg-white p-10 rounded-xl flex w-[480px] flex-col items-center justify-center">
        <div class="h-16 w-16 shadow-sm rounded-xl overflow-hidden">
            <img class="h-full w-full object-contain" src="https://logosandtypes.com/wp-content/uploads/2022/03/Fxra.png"
                alt="">
        </div>
        <h2 class="text-xl 2xl:text-2xl mt-5 font-bold font-['poppins']">Welcome Back!</h2>
        <p class="text-gray-600 text-center mt-1 2xl:mt-3">Sign in to explore and book the best events around you.</p>
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
                <div class="divider text-gray-500 font-bold">OR</div>
                <a href="{{ route('auth.platform.redirect', ['platform' => 'google']) }}">
                    <button class="btn btn-secondary w-full h-12" type="button">
                        <div class="h-6 w-6">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/1200px-Google_%22G%22_logo.svg.png"
                                alt="" class="h-full w-full object-contain">
                        </div>
                        Continue with Google
                    </button>
                </a>
                <p class="mt-3">Don't have account ? <a href="{{ route('register') }}"
                        class="text-primary underline">Signup</a></p>
            </div>
        </form>
    </div>
</div>
