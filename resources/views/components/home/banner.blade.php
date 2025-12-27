<div class="px-5 py-5">
    <div>
        <div class="swiper banner" x-data="{
            init() {
                var swiper = new Swiper('.banner', {
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
                @foreach ($this->latest_events as $event)
                    <x-home.banner-event :event="$event" />
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
