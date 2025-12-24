<div class="px-5 py-20">
    <div class="mb-10 w-fit bg-linear-to-r from-primary to-white bg-clip-text">
        <h2 class="text-2xl font-bold text-transparent flex gap-2 items-center">Upcoming Events</h2>
    </div>
    <div>
        <div class="swiper upcomingevents" x-data="{
            init() {
                var swiper = new Swiper('.upcomingevents', {
                    slidesPerView: 4,
                    spaceBetween: 20,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            }
        }">
            <div class="swiper-wrapper">
                @foreach ($this->events as $event)
                    <x-home.upcoming-event :event="$event" />
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
