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
                <x-home.upcoming-event
                    image="https://images.pexels.com/photos/2608517/pexels-photo-2608517.jpeg?cs=srgb&dl=pexels-bertellifotografia-2608517.jpg&fm=jpg" />
                <x-home.upcoming-event
                    image="https://applescoop.org/image/wallpapers/mac/official-apple-event-m4-chipset-processor-logo-october-2024-winking-finder-mac-28-10-2024-1730152446-hd-wallpaper.png" />
                <x-home.upcoming-event image="https://wallpapercave.com/wp/wp8783355.jpg" />
                <x-home.upcoming-event
                    image="https://images.unsplash.com/photo-1531058020387-3be344556be6?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8ZXZlbnR8ZW58MHx8MHx8fDA%3D" />
                <x-home.upcoming-event
                    image="https://img.pastemagazine.com/wp-content/avuploads/2025/08/29095820/a-history-of-violence-header.jpg" />
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
