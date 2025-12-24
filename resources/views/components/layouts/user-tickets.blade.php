<x-layouts.app>
    <div class="px-46 py-10">
        <div class="flex gap-2 items-center text-white/50">
            <a href="#">Home</a>
            <x-heroicon-m-chevron-right class="h-5 w-5" />
            <a href="#" class="text-primary">{{ $title }}</a>
        </div>
        <div class="mt-5 space-y-2 w-[40%]">
            <h2 class="font-bold text-5xl tracking-tight">{{ $title }}</h2>
            <p class="text-xl text-white/50">{{ $description }}
            </p>
        </div>
        <div class="mt-10">
            <div class="flex gap-5 mb-5">
                <a href="{{ route('user.reservations') }}"
                    class="h-8 font-semibold w-fit border-b-2  {{ url()->current() == route('user.reservations') ? 'border-primary  text-primary' : 'border-transparent' }} cursor-pointer">
                    Reservations
                </a>
                <a href="{{ route('user.bookings') }}"
                    class="h-8 font-semibold w-fit border-b-2  {{ url()->current() == route('user.bookings') ? 'border-primary  text-primary' : 'border-transparent' }} cursor-pointer">
                    Bookings
                </a>
                {{-- <div
                    class="h-8 font-semibold w-fit border-b-2 border-transparent text-white/50 cursor-pointer hover:text-white duration-300">
                    Booked
                    Tickets</div>
                <div
                    class="h-8 font-semibold w-fit border-b-2 border-transparent text-white/50 cursor-pointer hover:text-white duration-300">
                    Past Events
                </div> --}}
            </div>
            <div>
                {{ $slot }}
            </div>
        </div>
    </div>
    </div>
</x-layouts.app>
