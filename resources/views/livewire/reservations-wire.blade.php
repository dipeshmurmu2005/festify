<div>
    <div class="grid grid-cols-3 gap-4">
        @foreach ($this->reservations as $reservation)
            <x-elements.reservation :reservation="$reservation" />
        @endforeach
    </div>
</div>
