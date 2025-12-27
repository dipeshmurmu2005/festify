<div class="px-5 py-5 flex justify-between items-center bg-base-100 border-b border-white/5 sticky top-0 z-50">
    <div class="flex gap-5 items-center">
        <a href="{{ route('home') }}">
            <div class="bg-white/10 w-12 h-12 text-4xl text-primary pt-2 rounded-md flex justify-center items-center">
                <span class="font-astonish">f</span>
            </div>
        </a>
        <div class="text-sm font-semibold">
            <a href="{{ route('explore') }}"
                class="text-white/80 w-fit px-4 py-2 rounded-full hover:bg-white/10 hover:text-primary duration-300">Discover</a>
            <div class="dropdown">
                <div tabindex="0" role="button"
                    class="text-white/80 w-fit px-4 py-2 rounded-full hover:bg-white/10 hover:text-primary duration-300 cursor-pointer">
                    Categories</div>
                <div class="dropdown-content p-4 bg-neutral border border-white/5 rounded-xl w-150">
                    <div class="grid grid-cols-2">
                        @foreach ($this->categories as $category)
                            <a href="{{ route('explore', ['category' => $category->id]) }}" class="group">
                                <div
                                    class="flex gap-4 items-center group-hover:bg-black/20 p-3 rounded-xl duration-300">
                                    <div
                                        class="p-2 bg-white/5 border border-white/5 h-12 rounded-xl w-12 flex justify-center items-center relative">
                                        @if ($category->is_new)
                                            <div
                                                class="absolute left-0 -top-4 rounded-md w-full p-1 text-center font-space italic bg-primary text-black text-xs">
                                                New
                                            </div>
                                        @endif
                                        <x-icon name="{{ $category->icon }}" class="h-6 w-6" />
                                    </div>
                                    <div>
                                        <span>{{ $category->name }}</span>
                                        <p class="text-xs font-medium text-white/50">{{ $category->description }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                {{-- <ul tabindex="-1" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                    <li><a>Item 1</a></li>
                    <li><a>Item 2</a></li>
                </ul> --}}
            </div>
            <a href="{{ route('user.bookings') }}"
                class="text-white/80 w-fit px-4 py-2 rounded-full hover:bg-white/10 hover:text-primary duration-300">My
                Bookings</a>
        </div>
    </div>
    <div class="flex gap-2 items-center">
        @guest
            <a href="{{ route('organizer.overview') }}">
                <button class="btn btn-md rounded-full btn-neutral border border-white/10">Become Organizer</button>
            </a>
            <a href="{{ route('login') }}">
                <button
                    class="btn btn-primary btn-outline btn-md rounded-full bg-primary/5 hover:text-primary">Login</button>
            </a>
            <a href="{{ route('register') }}">
                <button class="btn btn-primary btn-md rounded-full">Sign up</button>
            </a>
        @endguest

        @auth
            @if (auth()->user()->organizer)
                <a href="{{ route('filament.organizer.pages.dashboard', ['tenant' => auth()->user()->organizer->id]) }}">
                    <button class="btn btn-md rounded-full btn-neutral border border-white/10">Switch to Organizer</button>
                </a>
            @else
                <a href="{{ route('setup.organizer') }}">
                    <button class="btn btn-md rounded-full btn-neutral border border-white/10">Become Organizer</button>
                </a>
            @endif
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn m-1 btn-circle overflow-hidden btn-primary">
                    <img src="https://variety.com/wp-content/uploads/2023/06/avatar-1.jpg?w=1000&h=563&crop=1"
                        alt="" class="h-full w-full object-cover">
                </div>
                <ul tabindex="-1"
                    class="dropdown-content menu bg-neutral border border-white/10 rounded-box z-1 w-52 p-2 shadow-sm">
                    <li><a href="{{ route('user.profile') }}">Profile</a></li>
                    <li class="cursor-pointer">
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button class="cursor-pointer">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</div>
