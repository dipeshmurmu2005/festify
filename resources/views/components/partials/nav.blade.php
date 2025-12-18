<div class="px-5 py-5 flex justify-between items-center">
    <div class="flex gap-5 items-center">
        <a href="{{ route('home') }}">
            <div class="bg-white/10 w-12 h-12 text-4xl text-primary pt-2 rounded-md flex justify-center items-center">
                <span class="font-astonish">f</span>
            </div>
        </a>
        <div class="text-sm font-semibold">
            <a href="{{ route('home') }}"
                class="text-white/80 w-fit px-4 py-2 rounded-full hover:bg-white/10 hover:text-primary duration-300">Explore</a>
            <a href="#"
                class="text-white/80 w-fit px-4 py-2 rounded-full hover:bg-white/10 hover:text-primary duration-300">Events</a>
        </div>
    </div>
    <div class="flex gap-2 items-center">
        <button class="btn btn-md rounded-full btn-neutral border border-white/10">Become Organizer</button>
        @guest
            <a href="{{ route('login') }}">
                <button
                    class="btn btn-primary btn-outline btn-md rounded-full bg-primary/5 hover:text-primary">Login</button>
            </a>
            <button class="btn btn-primary btn-md rounded-full">Sign up</button>
        @endguest

        @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn m-1 btn-circle overflow-hidden btn-primary">
                    <img src="https://variety.com/wp-content/uploads/2023/06/avatar-1.jpg?w=1000&h=563&crop=1"
                        alt="" class="h-full w-full object-cover">
                </div>
                <ul tabindex="-1"
                    class="dropdown-content menu bg-neutral border border-white/10 rounded-box z-1 w-52 p-2 shadow-sm">
                    <li><a>Profile</a></li>
                </ul>
            </div>
        @endauth
    </div>
</div>
