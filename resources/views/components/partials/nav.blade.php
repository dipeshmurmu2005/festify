<div class="md:px-32 2xl:px-46 py-5">
    <div class="flex justify-between items-center">
        <a href="{{ route('home') }}" wire:navigate>
            <div class="logo">
                <h2 class="font-['poppins'] md:text-lg 2xl:text-xl tracking-wide font-light italic"><span
                        class="font-bold text-primary">F</span>estify</h2>
            </div>
        </a>
        <div>
            <label for="search"
                class="bg-gray-50 border border-gray-100 rounded-full md:py-1 md:px-1 2xl:p-2 flex items-center">
                <input type="text" autofill="false"
                    class="outline-none 2xl:text-sm md:text-xs 2xl:h-full px-5 md:w-[300px] 2xl:w-[400px]"
                    placeholder="Search Events" id="search">
                <button class="btn btn-primary btn-circle btn-sm">
                    <x-heroicon-o-magnifying-glass class="h-5 w-5" />
                </button>
            </label>
        </div>
        <div class="flex gap-5 items-center">
            <a href="#"><button class="btn btn-ghost rounded-full 2xl:text-sm md:text-xs">Find
                    Events</button></a>
            <a href="#"><button class="btn btn-ghost rounded-full 2xl:text-sm md:text-xs">Create
                    Events</button></a>
            <a href="#"><button class="btn btn-ghost rounded-full 2xl:text-sm md:text-xs">Find My
                    Ticket</button></a>
            @if (auth()->user())
                <button class="flex items-center cursor-pointer" popovertarget="popover-1"
                    style="anchor-name:--anchor-1">
                    <div x-data="{
                        name: '{{ auth()->user()->name }}',
                        letter: null,
                        init() {
                            this.letter = this.name.split('')[0];
                        }
                    }">
                        <div class="avatar avatar-placeholder">
                            <div class="bg-success text-neutral-content md:w-10 2xl:w-12 rounded-full">
                                <span class="text-lg font-bold" x-text="letter"></span>
                            </div>
                        </div>
                    </div>
                </button>
            @else
                <a href="{{ route('login') }}" wire:navigate><button
                        class="btn btn-ghost rounded-full">Login</button></a>
                <a href="{{ route('register') }}" wire:navigate><button
                        class="btn btn-primary rounded-full">Signup</button></a>
            @endif
        </div>
    </div>
    <ul class="dropdown menu md:text-sm 2xl:text-lg font-['inter'] w-[300px] rounded-box bg-base-100 shadow-sm" popover
        id="popover-1" style="position-anchor:--anchor-1">
        <li><a href="{{ route('user.profile') }}" wire:navigate class="md:py-5 2xl:py-3"><x-heroicon-m-user
                    class="h-5 w-5 text-primary" />
                Profile</a></li>
        <li><a class="md:py-5 2xl:py-3"><x-heroicon-m-cog class="h-5 w-5 text-primary" />Settings</a></li>
        <li><a class="md:py-5 2xl:py-3"><x-heroicon-m-arrows-right-left class="h-5 w-5 text-primary" />Switch to Service
                Provider</a></li>
        <li>
            <form action="{{ route('user.logout') }}" method="POST">
                @csrf
                <button class="md:py-5 2xl:py-3 flex gap-2 cursor-pointer items-center"><x-heroicon-m-power
                        class="h-5 w-5 text-primary" />Logout</button>
            </form>
        </li>
    </ul>
</div>
