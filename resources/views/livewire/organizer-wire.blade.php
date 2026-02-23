<div>
    <div class="bg-gradient-to-r from-primary/50 py-3 font-space font-semibold via-secondary/50 to-primary/50 p-2">
        <h3 class="text-center">Announcing our $15M Series A led by Accel — and Prism, our agentic reporting layer, is
            now live</h3>
    </div>
    <div class="px-5 py-10">
        <div class="w-[40%] space-y-5">
            <div class="px-5 py-2 bg-white/10 border border-white/10 w-fit rounded-full">Free until your first customer
            </div>
            <h1 class="text-4xl font-semibold font-inter leading-snug">Grow Your Event Management Business, Minus the
                Hassle</h1>
            <p class="text-base text-white/50">Accept payments, manage tasks, and communicate with your clients with your
                very own
                white-labelled client
                portal. <span class="text-white">5-min setup, ready to go this morning.</span></p>
            <div>
                <a href="{{ route('register') }}">
                    <button class="btn btn-info h-12 rounded-xl">Become an Organizer</button>
                </a>
            </div>
        </div>
        <div class="mt-10 relative">
            <div class="absolute left-0 top-0 h-full w-[500px] z-30 bg-gradient-to-r from-base-100  to-transparent">
            </div>
            <div class="swiper companies" x-data="{
                init() {
                    var swiper = new Swiper('.companies', {
                        slidesPerView: 10,
                        spaceBetween: 30,
                        autoplay: true,
                        pagination: {
                            el: '.swiper-pagination',
                            clickable: true,
                        },
                    });
                }
            }">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="h-16">
                            <img src="https://app.ashbyhq.com/api/images/org-theme-wordmark/585feb03-8a10-4a35-8477-d081544cfc4c/61bc0a75-7f99-4cd2-b070-172f0dcd3a49/d501e6c2-ec79-4ca2-b378-74d5a7aafabd.png"
                                alt="" class="invert h-full w-full object-contain">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-16 p-2">
                            <img src="https://logos-world.net/wp-content/uploads/2020/04/Adidas-Logo-1967-present.png"
                                alt="" class="invert h-full w-full object-contain">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-16 p-4">
                            <img src="https://a.storyblok.com/f/290844/393x124/b3f86eecfc/revolut.png/m/3840x1212/filters:blur(0)"
                                alt="" class="invert h-full w-full object-contain">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-16 p-5">
                            <img src="https://cdn.prod.website-files.com/656df30166253094650a652a/685bd8ae7780a44edf99e057_legacy_logo_rgb_softblack.png"
                                alt="" class="invert h-full w-full object-contain">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-16">
                            <img src="https://zyppy.com/wp-content/uploads/2025/02/Logo-RETINES-carre-noir-768x768.png"
                                alt="" class="invert h-full w-full object-contain">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-16 p-5">
                            <img src="https://www.insightpartners.com/wp-content/uploads/2025/09/writer_pianokey_tile3.png"
                                alt="" class="invert h-full w-full object-contain">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-16 p-4">
                            <img src="https://fossilfreefinance.org/wp-content/uploads/2024/06/BOCC@3x.png"
                                alt="" class="invert h-full w-full object-contain">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-16 p-1">
                            <img src="https://edwardstruckcenter.com/wp-content/uploads/2015/05/autocar.png"
                                alt="" class="invert h-full w-full object-contain">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-16 p-4">
                            <img src="https://a.storyblok.com/f/290844/311x112/974305e25f/odoo.png/m/3840x1383/filters:blur(0)"
                                alt="" class="invert h-full w-full object-contain">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-16 p-4">
                            <img src="https://a.storyblok.com/f/290844/341x121/fa71be7722/google.png/m/3840x1363/filters:blur(0)"
                                alt="" class="invert h-full w-full object-contain">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="h-16 p-4">
                            <img src="https://a.storyblok.com/f/290844/393x124/b3f86eecfc/revolut.png/m/3840x1212/filters:blur(0)"
                                alt="" class="invert h-full w-full object-contain">
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute right-0 top-0 h-full w-[500px] z-30 bg-gradient-to-l from-base-100  to-transparent">
            </div>
        </div>
    </div>
    <div class="px-32 pt-18 h-[800px] overflow-hidden relative">
        <div class="rounded-xl overflow-hidden">
            <img src="{{ asset('images/dashboard.png') }}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="absolute left-0 top-0 h-full w-full bg-gradient-to-t from-base-100 to-transparent">

        </div>
    </div>
    <div class="px-32 pt-32 pb-20">
        <div class="bg-white/5 p-16 rounded-xl">
            <div class="grid grid-cols-5 gap-10">
                <div class="space-y-2">
                    <div
                        class="h-14 w-14 rounded-xl border border-white/5 text-white/70 flex justify-center items-center bg-white/5">
                        <x-hugeicons-calendar-02 class="h-6 w-6" />
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg">Event Management</h2>
                        <p class="text-white/50">Create, manage, and publish events with full control over schedules,
                            venues, and visibility.
                        </p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div
                        class="h-14 w-14 rounded-xl border border-white/5 text-white/70 flex justify-center items-center bg-white/5">
                        <x-heroicon-o-ticket class="h-6 w-6" />
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg">Smart Ticketing</h2>
                        <p class="text-white/50">Multiple ticket types, QR-based tickets, discounts, and real-time
                            availability tracking.
                        </p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div
                        class="h-14 w-14 rounded-xl border border-white/5 text-white/70 flex justify-center items-center bg-white/5">
                        <x-hugeicons-lock-password class="h-6 w-6" />

                    </div>
                    <div>
                        <h2 class="font-semibold text-lg">Secure Payments</h2>
                        <p class="text-white/50">Accept online payments, track revenue, and manage payouts from a single
                            dashboard.
                        </p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div
                        class="h-14 w-14 rounded-xl border border-white/5 text-white/70 flex justify-center items-center bg-white/5">
                        <x-hugeicons-presentation-bar-chart-01 class="h-6 w-6" />
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg">Insights & Analytics</h2>
                        <p class="text-white/50">Understand your event performance with real-time sales, attendance, and
                            revenue insights.
                        </p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div
                        class="h-14 w-14 rounded-xl border border-white/5 text-white/70 flex justify-center items-center bg-white/5">
                        <x-hugeicons-location-user-02 class="h-6 w-6" />
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg">Attendee Control</h2>
                        <p class="text-white/50">Manage attendees, scan tickets, and monitor check-ins seamlessly
                            during
                            events.
                        </p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div
                        class="h-14 w-14 rounded-xl border border-white/5 text-white/70 flex justify-center items-center bg-white/5 relative">
                        <div
                            class="absolute -top-2 -right-12 bg-primary p-1 text-xs text-black font-space italic rounded-md font-semibold">
                            Upcoming
                        </div>
                        <x-hugeicons-promotion class="h-6 w-6" />
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg">Promotion Tools</h2>
                        <p class="text-white/50">Boost reach with promo codes, featured events, and shareable event
                            links.
                        </p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div
                        class="h-14 w-14 rounded-xl border border-white/5 text-white/70 flex justify-center items-center bg-white/5">
                        <x-heroicon-o-sparkles class="h-6 w-6" />
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg">Full Control</h2>
                        <p class="text-white/50">Set refund rules, ticket visibility, and organizer preferences your
                            way.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
