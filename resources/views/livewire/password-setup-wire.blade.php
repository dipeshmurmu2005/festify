<div class="h-[100vh] flex justify-center items-center bg-gray-50">
    <div class="border border-gray-100 bg-white p-10 rounded-xl flex w-[480px] flex-col items-center justify-center">
        <div class="h-16 w-16 shadow-sm rounded-xl overflow-hidden">
            <img class="h-full w-full object-contain" src="https://logosandtypes.com/wp-content/uploads/2022/03/Fxra.png"
                alt="">
        </div>
        <h2 class="text-2xl mt-5 font-bold">Setup Your Credentials</h2>
        <p class="text-gray-600 text-center mt-3">Add your credentials to keep everything safe.</p>
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
