<div class="px-46">
    <div class="grid grid-cols-4 gap-10 bg-gradient-to-r from-blue-50 to-white p-10 rounded-2xl">
        <div class="py-20">
            <h2
                class="font-bold font-['poppins'] text-2xl text-primary after:h-1 after:rounded-full after:w-[100px] after:block after:bg-primary after:mt-2">
                Upcoming
                Events</h2>
            <p class="mt-5 text-gray-700 leading-7">Stay in the loop! Explore upcoming events, workshops, and meetups
                happening
                soon. Don’t
                miss out—mark
                your calendar today!</p>
            <a href="#">
                <button class="mt-5 rounded-full font-bold btn btn-primary">Find More</button>
            </a>
        </div>
        <div class="col-span-3 py-20">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <x-home.banner-event />
                    <x-home.banner-event />
                    <x-home.banner-event />
                    <x-home.banner-event />
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 3.2,
                spaceBetween: 30,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        });
    </script>
</div>
