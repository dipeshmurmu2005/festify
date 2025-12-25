<div class="ticket">
    <div class="ticket-header">
        <h2>Ticket Number</h2>
        <h3>#{{ $ticket->ticket_code }}</h3>
    </div>

    <div class="event-title">
        {{ $ticket->event->title }}
    </div>

    <div class="info-grid">
        <div class="info-row">
            <div class="info-col">
                <div class="info-label">Ticket Type</div>
                <div class="info-value">{{ $ticket->ticket->title }}</div>
            </div>
            <div class="info-col">
                <div class="info-label">Booked By</div>
                <div class="info-value">{{ $ticket->user->name }}</div>
            </div>
        </div>

        <div class="info-row">
            <div class="info-col">
                <div class="info-label">Event Date</div>
                <div class="info-value">
                    {{ Carbon\Carbon::parse($ticket->event_date)->format('d M, Y') }}
                </div>
            </div>
        </div>
    </div>

    <div class="barcode">
        <div style="height:64px;">
            <img src="data:image/png;base64,{{ $ticket->bar_code }}">
        </div>
    </div>
</div>
<style>
    .barcode img {
        height: 100%;
        width: 100%;
        object-fit: contain;
    }

    .ticket {
        background: #ffffff;
        padding: 24px;
        border-radius: 16px;
        color: black;
    }

    .ticket-header {
        margin-bottom: 24px;
    }

    .ticket-header h2 {
        font-size: 12px;
        font-weight: 400;
        color: #6b7280;
        margin: 0 0 4px 0;
    }

    .ticket-header h3 {
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .event-title {
        font-size: 26px;
        font-weight: bold;
        margin: 16px 0;
        line-height: 1.2;
    }

    .info-grid {
        display: table;
        width: 100%;
        margin-top: 16px;
    }

    .info-row {
        display: table-row;
    }

    .info-col {
        display: table-cell;
        width: 50%;
        padding: 8px 0;
        vertical-align: top;
    }

    .info-label {
        font-size: 11px;
        color: #6b7280;
        margin-bottom: 2px;
    }

    .info-value {
        font-size: 14px;
        font-weight: 400;
    }

    .barcode {
        margin-top: 40px;
        text-align: center;
    }

    svg {
        max-width: 100%;
        height: auto;
    }
</style>
