<div>
    <div class="px-80 py-10">
        <div class="flex gap-2 items-center text-white/50">
            <a href="#">My Tickets</a>
            <x-heroicon-m-chevron-right class="h-5 w-5" />
            <a href="#" class="text-primary">Reservations</a>
        </div>
        <div class="mt-5 space-y-2 w-[70%]">
            <h2 class="font-bold text-5xl tracking-tight">Reservation #9302 Details</h2>
            <p class="text-xl text-white/50">View details and verify your payment for converting this to booking
            </p>
        </div>
        <div class="mt-10">
            <div class="grid grid-cols-4 gap-10">
                <div class="col-span-2 border-2 rounded-xl border-white/10 h-fit">
                    <div class="rounded-2xl overflow-hidden">
                        <div class="h-[500px] relative">
                            <img src="https://www.grandweddings.co.in/wp-content/uploads/2020/01/Top-Wedding-Event-Management-Companies-in-Hyderabad.jpg"
                                alt="" class="h-full w-full object-cover">
                            <div
                                class="absolute left-0 top-0 bg-gradient-to-t h-full w-full from-black to-transparent flex items-end">
                                <div class="p-10 space-y-2">
                                    <h2 class="text-primary">Club</h2>
                                    <h1 class="text-3xl font-bold">Summer Music Festival</h1>
                                    <div class="flex items-center gap-2 text-white/50"><x-heroicon-m-map-pin
                                            class="h-5 w-5" />
                                        Birtamode 1 Jhapa, Nepal</div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white/5 py-8">
                            <div class="px-10">
                                <div class="flex gap-2 items-center font-semibold text-lg">
                                    <div
                                        class="h-12 w-12 rounded-full flex justify-center items-center text-primary bg-white/10">
                                        <x-heroicon-m-ticket class="h-5 w-5" />
                                    </div>
                                    Ticket
                                    Information
                                </div>
                            </div>
                            <div class="divide-y divide-white/5">
                                <div class="grid grid-cols-2 gap-5 px-10 py-5">
                                    <div class="grid gap-2">
                                        <span class="text-white/50">TICKET ID</span>
                                        <span class="font-semibold">#R-382</span>
                                    </div>
                                    <div class="grid gap-2">
                                        <span class="text-white/50">TICKET TYPE</span>
                                        <span class="font-semibold">Early Bird</span>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-5 px-10 py-5">
                                    <div class="grid gap-2">
                                        <span class="text-white/50">TOTAL AMOUNT</span>
                                        <span class="font-semibold">Rs. 5,000</span>
                                    </div>
                                    <div class="grid gap-2">
                                        <span class="text-white/50">RESERVATION EXPIRY</span>
                                        <span class="font-semibold">14:59</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-2 space-y-10">
                    <div class="bg-white/5 border-2 border-white/10 p-10 rounded-2xl">
                        <div class="flex gap-2 items-center">
                            <div>
                                <div
                                    class="h-14 w-14 bg-white/10 rounded-full flex justify-center text-primary items-center">
                                    <x-heroicon-m-wallet class="h-6 w-6" />
                                </div>
                            </div>
                            <div class="w-full">
                                <h2 class="text-xl font-bold flex justify-between w-full">Payment Verification</h2>
                                <p class="text-white/50">Payment verification is required to finalize this reservation.
                                </p>
                            </div>
                        </div>
                        <div class="mt-5 bg-black/30 p-5 rounded-xl flex justify-between items-center">
                            <div>
                                <div class="text-sm font-semibold text-white/50">Payment Method</div>
                                <h2 class="text-xl font-semibold">Summer Music Festival</h2>
                            </div>
                            <div>
                                <span
                                    class="bg-primary/10 text-primary px-3 py-2 rounded-full font-semibold">eSewa</span>
                            </div>
                        </div>
                        @if ($this->reservation->payment && $this->reservation->payment->status->value == 'failed')
                            <div
                                class="p-10 h-[150px] rounded-2xl overflow-hidden relative bg-white/5 border-2 border-white/5 mt-5 gap-2 flex justify-center items-center flex-col">
                                <div>
                                    <div
                                        class="h-14 w-14 flex justify-center items-center rounded-full bg-error/10 text-error">
                                        <x-heroicon-m-x-mark class="h-8 w-8" />
                                    </div>
                                </div>
                                <div>
                                    <h2 class="text-xl font-semibold text-white/50">Verification Failed</h2>
                                </div>
                            </div>
                        @endif
                        @if ($this->reservation->payment && $this->reservation->payment->status->value != 'failed')
                            @if ($this->reservation->payment->status->value == 'verified')
                                <div
                                    class="p-10 h-[200px] rounded-2xl overflow-hidden relative bg-white/5 border-2 border-white/5 mt-10 gap-2 flex justify-center items-center flex-col">
                                    <img src="https://cdn3d.iconscout.com/3d/premium/thumb/confetti-3d-icon-png-download-5326774.png"
                                        alt="" class="h-full w-full object-cover absolute opacity-10">
                                    <div
                                        class="h-14 w-14 flex justify-center items-center rounded-full bg-primary/10 text-primary">
                                        <x-heroicon-m-check-badge class="h-8 w-8" />
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-semibold">Verified 🎉</h2>
                                    </div>
                                </div>
                            @else
                                <div
                                    class="p-10 rounded-2xl bg-white/5 mt-10 gap-2 flex justify-center items-center flex-col">
                                    <div
                                        class="h-14 w-14 flex justify-center items-center rounded-full bg-warning/10 text-warning">
                                        <x-hugeicons-loading-01 class="h-8 w-8" />
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-semibold">Pending</h2>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="mt-5">
                                <div class="rounded-xl overflow-hidden">
                                    <img src="https://images.ctfassets.net/txhaodyqr481/4b1eRtWildSd4ZJsmRXCoM/08c186e0ff890bc6c57f6090a077ca81/Group_1.png?q=85&w=800&h=800"
                                        alt="">
                                </div>
                            </div>
                            <div class="mt-5">
                                <fieldset class="fieldset w-full">
                                    <legend class="fieldset-legend">Esewa ID</legend>
                                    <input type="text" wire:model="payer_id"
                                        class="input w-full h-16 rounded-full px-10" placeholder="eg. 9815937651" />
                                    </p>
                                </fieldset>
                                <fieldset class="fieldset w-full">
                                    <legend class="fieldset-legend">eSewa Transaction ID</legend>
                                    <input type="text" wire:model="token"
                                        class="input w-full h-16 rounded-full px-10" placeholder="eg. 49034092" />
                                    <p class="label">Enter the 10 digit transaction code from customer's payment
                                        receipt
                                    </p>
                                </fieldset>
                            </div>
                            <div x-data="{
                                init() {
                                        $wire.on('redirect-to-payment', () => {
                                            this.submitPayment();
                                        });
                                    },
                                    submitPayment() {
                                        document.getElementById('payment').submit();
                                    }
                            }" class="mt-5 pt-5 border-t border-white/5">
                                @if ($this->payment_params)
                                    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" id="payment"
                                        method="POST">
                                        @csrf
                                        @foreach ($this->payment_params as $key => $params)
                                            <input type="text" id="amount" name="{{ $key }}"
                                                value="{{ $params }}" required>
                                        @endforeach
                                    </form>
                                @endif
                                <div class="space-y-5">
                                    <button wire:click="requestPayment()"
                                        class="btn btn-primary h-16 px-5 rounded-full w-full"><x-heroicon-m-check-badge
                                            class="h-6 w-6" /> Verify & Book
                                        Ticket</button>
                                    <button class="btn btn-neutral h-16 px-5 rounded-full w-full"><x-heroicon-m-x-mark
                                            class="h-6 w-6" /> Cancel Reservation</button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white/5 border-2 border-white/10 p-10 rounded-2xl">
                        <div class="flex gap-2">
                            <div><x-heroicon-m-information-circle class="h-8 w-8 text-white/20" /></div>
                            <div>
                                <h2 class="font-semibold">Need Help ?</h2>
                                <p class="text-white/50">Verify the amount matches Rs. 3,290 before confirming. This
                                    action cannot be undone
                                    easily</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
