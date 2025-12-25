<x-layouts.app>
    <div class="px-5">
        <div class="py-5">
            <h2 class="text-2xl font-bold">Settings</h2>
        </div>
        <div class="border-t border-white/5 border-b py-5">
            <div class="flex gap-10">
                <a href="{{ route('user.profile.setting') }}" wire:current="text-primary"
                    class="font-medium cursor-pointer hover:text-primary duration-300">My Details</a>
                <a href="{{ route('user.security.setting') }}" wire:current="text-primary"
                    class="font-medium cursor-pointer hover:text-primary duration-300">Security</a>
            </div>
        </div>
        <div class="py-10">
            {{ $slot }}
        </div>
    </div>
</x-layouts.app>
