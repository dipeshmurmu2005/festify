<div class="2xl:px-46">
    @if (!$this->kyc_verification_help)
        <div class="h-[80vh] w-full rounded-2xl bg-[#f9f6ef] p-20">
            <div class="grid grid-cols-2 gap-5 h-full">
                <div class="flex items-center h-full">
                    <div class="h-fit">
                        <h2 class="text-5xl font-black uppercase leading-snug">Where Event Organizers Grow</h2>
                        <p class="text-2xl mt-5 text-gray-600">The all-in-one ticketing and discovery platform trusted by
                            millions of
                            organizers and
                            attendees
                            worldwide</p>
                        <div class="mt-5 flex gap-2">
                            <button class="btn btn-info btn-lg rounded-full text-sm" wire:click="getStarted()">Get Started
                                For Free</button>
                            <button class="btn btn-lg rounded-full text-sm border border-gray-200">Contact
                                Sales</button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <div class="h-full w-[80%] rounded-2xl overflow-hidden">
                        <img src="https://images.pexels.com/photos/2608517/pexels-photo-2608517.jpeg?cs=srgb&dl=pexels-bertellifotografia-2608517.jpg&fm=jpg"
                            alt="" class="h-full w-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex justify-center py-20 h-[80vh] items-center">
            <div class="border border-gray-200 w-[400px] rounded-2xl p-10">
                <div class="space-y-2">
                    <div class="flex justify-center">
                        <div class="bg-primary/10 p-5 rounded-full w-16 h-16 flex justify-center items-center">
                            <x-heroicon-m-exclamation-circle class="h-8 w-8 text-primary" />
                        </div>
                    </div>
                    <h2 class="font-bold text-lg text-center">Complete Your KYC Verification</h2>
                    <p class="text-justify text-gray-600">Your account isn’t fully verified yet. Head to <span
                            class="font-semibold">Profile
                            Settings → KYC
                            Verification</span> to complete
                        your verification and unlock all features.</p>
                    <div>
                        <button class="btn btn-primary w-full text-sm mt-5">Profile Setting</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
