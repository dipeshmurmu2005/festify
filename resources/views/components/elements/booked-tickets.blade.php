<div>
    @foreach ($tickets as $ticket)
        <div style="{{ $loop->iteration == $tickets->count() - 2 ? '' : 'page-break-after: always;' }}">
            <x-elements.booked-ticket-pdf :ticket="$ticket" />
        </div>
    @endforeach
</div>
