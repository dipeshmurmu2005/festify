<div>
    <div class="px-32 2xl:px-46 py-10">
        <div>
            <div x-data="{
                name: '{{ auth()->user()->name }}',
                letter: null,
                firstname: null,
                init() {
                    this.firstname = this.name.split(' ')[0];
                    this.letter = this.name.split('')[0];
                }
            }">
                <div class="flex gap-5 items-center">
                    <div class="avatar">
                        <div class="ring-primary ring-offset-base-100 w-12 rounded-full ring-2 ring-offset-2">
                            <img src="https://cdn.pixabay.com/photo/2022/03/11/06/14/indian-man-7061278_640.jpg" />
                        </div>
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg"> <span>Hi,</span> <span x-text="firstname"
                                class="text-primary"></span></h2>
                        <p class="font-semibold inline-flex gap-1 items-center">Level <span
                                class="h-5 w-5 rounded-full flex justify-center items-center bg-green-100 text-success">1</span>
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-5 mt-10">
                    <div class="bg-white p-5 rounded-lg border border-gray-200">
                        <h2 class="font-semibold">Ticket Activites</h2>
                        <div class="mt-3">
                            <ul class="space-y-2">
                                <li
                                    class="btn border-none font-normal h-12 bg-transparent hover:bg-gray-100 px-3 rounded-sm cursor-pointer flex justify-between items-center">
                                    <div class="flex gap-2 items-center">
                                        <x-heroicon-o-ticket class="h-4 w-4" />
                                        <h2>Tickets & Bookings</h2>
                                    </div>
                                    <x-heroicon-m-chevron-right class="h-4 w-4" />
                                </li>
                                <li
                                    class="btn border-none font-normal h-12 bg-transparent hover:bg-gray-100 px-3 rounded-sm cursor-pointer flex justify-between items-center">
                                    <div class="flex gap-2 items-center">
                                        <x-heroicon-o-heart class="h-4 w-4" />
                                        <h2>Saved List</h2>
                                    </div>
                                    <x-heroicon-m-chevron-right class="h-4 w-4" />
                                </li>
                                <li
                                    class="btn border-none font-normal h-12 bg-transparent hover:bg-gray-100 px-3 rounded-sm cursor-pointer flex justify-between items-center">
                                    <div class="flex gap-2 items-center">
                                        <x-heroicon-o-chat-bubble-oval-left class="h-4 w-4" />
                                        <h2>My Reviews</h2>
                                    </div>
                                    <x-heroicon-m-chevron-right class="h-4 w-4" />
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-lg border border-gray-200">
                        <h2 class="font-semibold">Manage Account</h2>
                        <div class="mt-3">
                            <ul class="space-y-2">
                                <a href="{{ route('user.profile.setting') }}">
                                    <li
                                        class="btn border-none font-normal h-12 bg-transparent hover:bg-gray-100 px-3 rounded-sm cursor-pointer flex justify-between items-center">
                                        <div class="flex gap-2 items-center">
                                            <x-heroicon-o-user class="h-4 w-4" />
                                            <h2>Personal Details</h2>
                                        </div>
                                        <x-heroicon-m-chevron-right class="h-4 w-4" />
                                    </li>
                                </a>
                                <li
                                    class="btn border-none font-normal h-12 bg-transparent hover:bg-gray-100 px-3 rounded-sm cursor-pointer flex justify-between items-center">
                                    <div class="flex gap-2 items-center">
                                        <x-heroicon-o-lock-closed class="h-4 w-4" />
                                        <h2>Security Settings</h2>
                                    </div>
                                    <x-heroicon-m-chevron-right class="h-4 w-4" />
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-white p-5 rounded-lg border border-gray-200">
                        <h2 class="font-semibold">Help & Support</h2>
                        <div class="mt-3">
                            <ul class="space-y-2">
                                <li
                                    class="btn border-none font-normal h-12 bg-transparent hover:bg-gray-100 px-3 rounded-sm cursor-pointer flex justify-between items-center">
                                    <div class="flex gap-2 items-center">
                                        <x-heroicon-o-phone class="h-4 w-4" />
                                        <h2>Contact Customer Service</h2>
                                    </div>
                                    <x-heroicon-m-chevron-right class="h-4 w-4" />
                                </li>
                                <li
                                    class="btn border-none font-normal h-12 bg-transparent hover:bg-gray-100 px-3 rounded-sm cursor-pointer flex justify-between items-center">
                                    <div class="flex gap-2 items-center">
                                        <x-heroicon-o-shield-check class="h-4 w-4" />
                                        <h2>Privacy & data managment</h2>
                                    </div>
                                    <x-heroicon-m-chevron-right class="h-4 w-4" />
                                </li>
                                <li
                                    class="btn border-none font-normal h-12 bg-transparent hover:bg-gray-100 px-3 rounded-sm cursor-pointer flex justify-between items-center">
                                    <div class="flex gap-2 items-center">
                                        <x-heroicon-o-document-check class="h-4 w-4" />
                                        <h2>Content Guidelines</h2>
                                    </div>
                                    <x-heroicon-m-chevron-right class="h-4 w-4" />
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
