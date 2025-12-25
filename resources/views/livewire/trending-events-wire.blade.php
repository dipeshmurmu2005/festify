<div class="px-5 py-5">
    <div class="mb-10 w-fit bg-linear-to-r from-primary to-white bg-clip-text">
        <h2 class="text-2xl font-bold text-transparent flex gap-2 items-center"><x-heroicon-m-fire
                class="h-8 w-8 text-primary" />
            Trending
            Events</h2>
    </div>
    <div>
        <div class="swiper trendingevents" x-data="{
            init() {
                var swiper = new Swiper('.trendingevents', {
                    slidesPerView: 5,
                    spaceBetween: 30,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            }
        }">
            <div class="swiper-wrapper">
                @foreach ($this->events as $event)
                    <x-elements.event :event="$event" />
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
