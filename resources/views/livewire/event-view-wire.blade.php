<div>
    <div class="2xl:px-96 pt-10">
        <div class="h-[500px] rounded-2xl overflow-hidden relative">
            <img src="https://wallpapers.com/images/featured/corporate-event-g6myc8i808y8llhh.jpg" alt=""
                class="h-full w-full object-cover">
        </div>
        <div class="grid grid-cols-5 gap-20">
            <div class="col-span-3 py-5">
                <div class="space-y-3">
                    <h2 class="text-4xl font-bold leading-snug">Apex Masters Expos – Investment Summit in Kathmandu,
                        Nepal</h2>
                    <div class="text-lg">
                        <div><span>Organized By</span> <span class="font-semibold text-primary">Apex Events</span></div>
                    </div>
                    <div>
                        <div class="space-y-1 mt-5 text-gray-600">
                            <div class="flex gap-2 items-center text-lg">
                                <x-heroicon-m-map-pin class="h-5 w-5" /> <span>Kathmandu</span>
                            </div>
                            <div class="flex gap-2 items-center text-lg">
                                <x-heroicon-m-calendar class="h-5 w-5" /> <span>Dec 11 at 9am to Dec 14 at 5am
                                    GMT+5:45</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2 py-5 h-fit sticky" x-data="{
                booked_tickets: @entangle('booked_tickets'),
                ticketReservationLoading: false,
                ticket_reserved: false,
                init() {
                    Livewire.on('refresh-booked_tickets', () => {
                        this.booked_tickets = [];
                    })
                },
                addTicket(ticket_id, limit, title, price) {
                    var findTicket = this.booked_tickets.find((ticket) => {
                        return ticket.id == ticket_id;
                    })
                    if (findTicket) {
                        if (findTicket.quantity < limit) {
                            findTicket.quantity += 1;
                        }
                    } else {
                        if (limit > 0) {
                            this.booked_tickets.push({
                                id: ticket_id,
                                quantity: 1,
                                title: title,
                                price: price,
                            })
                        }
                    }
                },
                removeTicket(ticket_id) {
                    var findTicket = this.booked_tickets.findIndex((ticket) => {
                        return ticket.id == ticket_id;
                    })
                    if (findTicket >= 0) {
                        if (this.booked_tickets[findTicket].quantity > 0) {
                            this.booked_tickets[findTicket].quantity -= 1;
                        } else {
                            this.booked_tickets.splice(findTicket, 1);
                        }
                    }
                },
                getTicketQuantity(ticket_id) {
                    var findTicket = this.booked_tickets.find((ticket) => {
                        return ticket.id == ticket_id;
                    })
                    return findTicket ? findTicket.quantity : 0;
                },
                bookTickets() {
                    reservation_confirmation_modal.showModal();
                },
                async confirmReservation() {
                    this.ticketReservationLoading = true;
                    Livewire.dispatch('reserve-tickets', this.booked_tickets);
                    var ticket = await new Promise((resolve, reject) => {
                        const cleanup = Livewire.on('ticket-reserved', () => {
                            resolve(true);
                            cleanup();
                            this.ticketReservationLoading = false;
                            this.ticket_reserved = true;
                        });
                    });
                },
                getTotal() {
                    var total = 0;
                    this.booked_tickets.forEach((ticket) => {
                        total += ticket.quantity * ticket.price;
                    })
                    return total;
                },
                closeReservation() {
                    reservation_confirmation_modal.close();
                    this.booked_tickets = [];
                    setTimeout(() => {
                        this.ticket_reserved = false;
                        this.refreshTickets();
                    }, 500);
                },
                refreshTickets() {
                    Livewire.dispatch('refresh-tickets');
                }
            }">
                <div class="p-5 border border-gray-200 rounded-xl">
                    <div>
                        <h2 class="text-lg font-semibold">Select Date & Sessions</h2>
                        <div class="divide-y divide-gray-300 mt-2">
                            <div class="pb-5">
                                @if ($this->event->schedule_type->value == 'single day')
                                    <div
                                        class="border cursor-pointer relative border-primary w-fit overflow-hidden grid space-y-2 text-center p-2 px-8 rounded-xl text-sm">
                                        <span
                                            class="uppercase">{{ Carbon\Carbon::parse($this->event->event_date)->format('D') }}</span>
                                        <span
                                            class="font-semibold">{{ Carbon\Carbon::parse($this->event->event_date)->format('d M') }}</span>
                                        <span>{{ Carbon\Carbon::parse($this->event->event_date)->format('Y') }}</span>
                                        <div
                                            class="absolute h-8 w-8 bg-primary right-0 rounded-bl-xl flex justify-center items-center text-white">
                                            <x-heroicon-m-check-circle class="h-5 w-5" />
                                        </div>
                                    </div>
                                @else
                                    <div wire:ignore x-data="{
                                        dateField: '{{ $this->date }}',
                                        init() {
                                            var datePicker = new AirDatepicker('#datepicker', {
                                                locale: localeEn,
                                                container: '#datepicker-container',
                                                dateFormat(date) {
                                                    return date.toLocaleString('en', {
                                                        year: 'numeric',
                                                        day: '2-digit',
                                                        month: 'numeric'
                                                    });
                                                },
                                                selectedDates: ['{{ $this->date }}'],
                                                visible: true,
                                                inline: true,
                                                minDate: new Date(
                                                    {{ Carbon\Carbon::parse($this->event->event_date)->year }},
                                                    {{ Carbon\Carbon::parse($this->event->event_date)->month - 1 }},
                                                    {{ Carbon\Carbon::parse($this->event->event_date)->day }}),
                                                maxDate: new Date(
                                                    {{ Carbon\Carbon::parse($this->event->end_date)->year }},
                                                    {{ Carbon\Carbon::parse($this->event->end_date)->month - 1 }},
                                                    {{ Carbon\Carbon::parse($this->event->end_date)->day }}),
                                            });
                                        },
                                        setDate(value) { $wire.set('date', value); }
                                    }" class="flex justify-center">
                                        <div id="datepicker-container" style="width:100%;">
                                            <input type="text" id="datepicker" class="!w-full"
                                                x-on:change="setDate($el.value)" x-model="dateField" hidden>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="pt-5 flex gap-3">
                                @if ($this->event->eventSessions->count())
                                    @foreach ($this->event->eventSessions as $session)
                                        <div>
                                            <input type="radio" id="{{ 'session-' . $session->id }}"
                                                wire:model.live="event_session" value="{{ $session->id }}" hidden>
                                            <label for="{{ 'session-' . $session->id }}"
                                                class="px-3 py-2 border w-fit {{ $this->event_session == $session->id ? 'border-primary' : 'border-gray-300' }} rounded-md cursor-pointer">
                                                {{ $session->label }}</label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 space-y-5">
                        @foreach ($this->tickets as $ticket)
                            <div class="border-[2px] grid grid-cols-3 rounded-md {{ $ticket['available'] == 0 ? 'grayscale opacity-50' : '' }}"
                                :class="getTicketQuantity({{ $ticket['id'] }}) > 0 ? 'border-primary' : 'border-black/50'"
                                wire:key="{{ 'ticket-' . $ticket['id'] }}">
                                <div class="col-span-2 flex justify-between">
                                    <div class="p-5 w-full">
                                        <h2 class="font-semibold text-base">{{ $ticket['title'] }}</h2>
                                        <p class="text-sm text-primary">More Info</p>
                                        <div class="mt-3 text-base">
                                            <span>Rs. </span> <span class="font-semibold">{{ $ticket['price'] }}</span>
                                        </div>
                                    </div>
                                    <div class="w-3 relative flex justify-center">
                                        <div class="bg-white h-4 w-8 rounded-b-full absolute -top-[2px]  border-2 border-t-white"
                                            :class="getTicketQuantity({{ $ticket['id'] }}) > 0 ? 'border-primary' :
                                                'border-black/50'">
                                        </div>
                                        <div class="h-full border-l border-dashed border-gray-600"></div>
                                        <div class="bg-white h-4 w-8 rounded-t-full absolute -bottom-[2px]  border-2 border-b-white"
                                            :class="getTicketQuantity({{ $ticket['id'] }}) > 0 ? 'border-primary' :
                                                'border-black/50'">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-center bg-primary/5">
                                    <div class="flex gap-2 items-center">
                                        <button @click="removeTicket({{ $ticket['id'] }})"
                                            class="btn btn-primary btn-outline btn-circle btn-sm">-</button>
                                        <span class="font-semibold"
                                            x-text="getTicketQuantity({{ $ticket['id'] }})"></span>
                                        <button class="btn btn-primary btn-outline btn-circle btn-sm"
                                            @click="addTicket({{ $ticket['id'] }},{{ $ticket['limit'] }},`{{ $ticket['title'] }}`,{{ $ticket['price'] }})">+</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if (count($errors) > 0)
                            <div class="bg-error/10 p-8 text-sm text-error rounded-xl border border-error/50">
                                <ul class="list-disc">
                                    @error('booked_tickets')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @foreach ($this->booked_tickets as $key => $ticket)
                                        @error('booked_tickets.' . $key)
                                            <li>{{ $message }}</li>
                                        @enderror
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div>
                            <template x-if="booked_tickets.length > 0">
                                <button @click="bookTickets()" class="btn btn-primary w-full rounded-full h-12 text-lg">
                                    <div><span>रु</span> <span x-text="getTotal()"></span></div>
                                    | Get
                                </button>
                            </template>
                            <template x-if="booked_tickets.length == 0">
                                <button class="btn tex-sm btn-primary w-full rounded-full h-12">
                                    @if ($this->date)
                                        Select Ticket To Proceed
                                    @else
                                        Select Date To Find Ticket
                                    @endif
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
                <dialog id="reservation_confirmation_modal" class="modal" wire:ignore.self
                    x-on:keydown.escape.window="closeReservation()">
                    <div class="modal-box">
                        <div>
                            <template x-if="ticket_reserved">
                                <div class="flex flex-col justify-center items-center gap-2">
                                    <div
                                        class="text-success flex justify-center items-center h-16 w-16 bg-success/10 rounded-full">
                                        <x-heroicon-m-check-badge class="h-10 w-10" />
                                    </div>
                                    <h2 class="text-2xl font-semibold text-success">Reservation Successfull</h2>
                                    <p class="text-center text-gray-600">Your reservation is completed! Check your
                                        profile to review
                                        your tickets and
                                        complete the payment to confirm your booking.</p>
                                </div>
                            </template>
                            <template x-if="!ticket_reserved">
                                <div class="flex justify-between items-center pb-5 border-b border-gray-200">
                                    <div>
                                        <h3 class="text-lg font-bold">Confirm your Reservation</h3>
                                        <p class="text-gray-600">Please review your selected tickets below.</p>
                                    </div>
                                    <form method="dialog">
                                        <button class="btn text-primary btn-circle"><x-heroicon-m-x-mark
                                                class="h-6 w-6" /></button>
                                    </form>
                                </div>
                            </template>
                            <div class="pt-5 space-y-5 pb-5">
                                <template x-for="(ticket,index) in booked_tickets">
                                    <div class="flex justify-between items-center">
                                        <div class="flex gap-4 items-center">
                                            <div
                                                class="h-12 w-16 rounded-sm bg-gray-100 flex justify-center items-center text-primary">
                                                <x-heroicon-m-ticket class="h-6 w-6" />
                                            </div>
                                            <div>
                                                <h2 class="font-semibold" x-text="ticket.title"></h2>
                                                <p class="text-gray-600 text-sm"><span x-text="ticket.quantity"></span>
                                                    x
                                                    <span>Rs. <span x-text="ticket.price"></span></span>
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="font-semibold">Rs. <span
                                                    x-text="ticket.price * ticket.quantity"></span></span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <div class="space-y-5 pt-5 border-t border-gray-200">
                                <div class="flex justify-between text-xl font-semibold">
                                    <span>Total</span>
                                    <span>Rs. <span x-text="getTotal()"></span></span>
                                </div>
                                <div>
                                    <template x-if="!ticket_reserved">
                                        <button @click="confirmReservation()" class="btn btn-primary w-full 2xl:h-16"
                                            :disabled="ticketReservationLoading">
                                            <template x-if="ticketReservationLoading">
                                                <span class="loading loading-sm"></span>
                                            </template>
                                            Confirm Reservation</button>
                                    </template>
                                    <template x-if="ticket_reserved">
                                        <button class="btn btn-primary w-full 2xl:h-16"
                                            @click="closeReservation()">Done</button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </dialog>
            </div>
        </div>
    </div>
    <style>
        .air-datepicker {
            width: 100% !important;
            border: none;
        }

        .air-datepicker-body--cells.-days- {
            grid-auto-rows: unset;
        }


        .air-datepicker-body--day-name {
            font-weight: 600;
            font-size: 14px;
            color: #f05537;
        }

        .air-datepicker-cell {
            border-radius: 8px;
            height: 50px;
            width: 50px;
            padding: 0px;
            font-size: 1rem;
            font-weight: bold;
            font-family: Inter;
            transition: 0.2s ease;
            color: #374151;
        }

        .air-datepicker-cell:hover {
            background: white;
        }

        .air-datepicker-cell.-selected- {
            background-color: #f05537;
        }

        .air-datepicker-cell.-current- {
            color: black;
        }

        .air-datepicker-cell.-current-.-selected- {
            background-color: #f05537;
        }

        .air-datepicker-cell.-selected-.air-datepicker-cell.-focus-:hover {
            background-color: #f05537;
        }
    </style>
</div>
