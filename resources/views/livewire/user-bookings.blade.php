<div>
    <div class="grid grid-cols-3 gap-5">
        @foreach ($this->bookings as $booking)
            <x-elements.booking :booking="$booking" />
        @endforeach
    </div>
</div>
