<div>
    @if ($this->password_setup)
        <div class="h-[100vh] flex justify-center items-center bg-gray-50">
            <div>
                <div class="mb-5">
                    <button class="btn btn-outline btn-primary rounded-full"
                        wire:click="goBack()"><x-heroicon-m-arrow-left class="h-5 w-5" />
                        Go Back</button>
                </div>
                <div
                    class="border border-gray-100 bg-white p-10 rounded-xl flex w-[480px] flex-col items-center justify-center">
                    <div class="h-16 w-16 shadow-sm rounded-xl overflow-hidden">
                        <img class="h-full w-full object-contain"
                            src="https://logosandtypes.com/wp-content/uploads/2022/03/Fxra.png" alt="">
                    </div>
                    <h2 class="text-2xl mt-5 font-bold font-['poppins']">Setup Your Credentials</h2>
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
        </div>
    @else
        @if (!$this->organizer_information)
            <div class="h-[100vh] flex justify-center items-center">
                <div class="grid grid-cols-2 gap-10 w-[50%]">
                    <div class="border border-gray-200 p-10 rounded-xl flex flex-col items-center gap-2">
                        <div class="h-48 w-48">
                            <img src="{{ asset('images/illustrations/ticketing.svg') }}" alt="">
                        </div>
                        <h2 class="font-semibold text-2xl">Find an Experience</h2>
                        <button class="btn btn-primary" wire:click="getStartedAsUser()"><span class="loading loading-xs"
                                wire:loading wire:target="getStartedAsUser()"></span> Get Started</button>
                    </div>
                    <div class="border border-gray-200 p-10 rounded-xl flex flex-col items-center gap-2">
                        <div class="h-48 w-48">
                            <img src="{{ asset('images/illustrations/organizing.svg') }}" alt="">
                        </div>
                        <h2 class="font-semibold text-2xl">Event Organizer</h2>
                        <button class="btn btn-info btn-outline" wire:click="getStartedAsOrganizer()"><span
                                class="loading loading-xs" wire:loading wire:target="getStartedAsOrganizer()"></span>Get
                            Started</button>
                    </div>
                </div>
            </div>
        @else
            <div class="h-[100vh] flex justify-center items-center">
                <div class="w-[450px] border border-gray-200 p-10 rounded-xl bg-white space-y-2">
                    <h2 class="font-bold text-2xl">Let’s Personalize Your <span class="text-primary">Organizer
                            Dashboard</span></h2>
                    <p class="text-gray-600">Help us tailor your dashboard for the best event organizing experience.</p>
                    <div class="mt-5">
                        <form wire:submit.prevent="continueAsOrganizer()">
                            <fieldset class="fieldset" x-data="{
                                individual: null,
                            }">
                                <legend class="fieldset-legend">Are you an individual organizer or a company?</legend>
                                <input type="radio" id="individual" x-model="individual" wire:model="individual"
                                    value="true" hidden>
                                <input type="radio" id="company" x-model="individual" wire:model="individual"
                                    value="false" hidden>
                                <div class="flex gap-2">
                                    <label for="individual"
                                        :class="individual == 'true' ? 'btn-primary hover:bg-transparent text-primary' :
                                            'border-gray-300'"
                                        class="btn {{ $this->individual == 'true' }} btn-outline text-xs rounded-full">Individual</label>
                                    <label for="company"
                                        :class="individual == 'false' ? 'btn-primary hover:bg-transparent text-primary' :
                                            'border-gray-300'"
                                        class="btn btn-outline text-xs rounded-full">Company</label>
                                </div>
                                @error('individual')
                                    <p class="label text-error">{{ $message }}</p>
                                @enderror
                            </fieldset>
                            <div class="mt-5">
                                <button class="btn btn-primary w-full h-12">Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
