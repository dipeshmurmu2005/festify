<div class="flex space-x-2" x-data="{
    tickets: @entangle('tickets'),
    addTicket(ticket_id) {
        var findTicketIndex = this.tickets.findIndex((ticket) => ticket == ticket_id);
        if (findIndex >= 0) {
            this.tickets.splice(findTicketIndex, 1);
        } else {
            this.tickets.push(ticket_id);
        }
    }
}">
    @foreach ($getOptions() as $value => $ticket)
        <div class="cardWrap !cursor-pointer" @click="addTicket({{ $value }})">
            <div class="card cardLeft">
                <h1>{{ $ticket['title'] }}</h1>
                <div class="title">
                    <h2>Rs. {{ $ticket['base_price'] }}</h2>
                    <span>Base Price</span>
                </div>
            </div>
            <div class="card cardRight">
                <div>
                    //
                </div>
                <div class="number">
                    <h3>{{ $ticket['available'] }}</h3>
                    <span>Available</span>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        .cardWrap {
            width: 27em;
            color: #fff;
            font-family: sans-serif;
        }

        .card {
            background: linear-gradient(to bottom, #e84c3d 0%, #e84c3d 26%, #ecedef 26%, #ecedef 100%);
            height: 11em;
            float: left;
            position: relative;
            padding: 1em;
        }

        .cardLeft {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            width: 16em;
        }

        .cardRight {
            width: 6.5em;
            border-left: .18em dashed #fff;
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;

            &:before,
            &:after {
                content: "";
                position: absolute;
                display: block;
                width: .9em;
                height: .9em;
                background: #fff;
                border-radius: 50%;
                left: -.5em;
            }

            &:before {
                top: -.4em;
            }

            &:after {
                bottom: -.4em;
            }
        }

        h1 {
            font-size: 1.1em;
            margin-top: 0;

            span {
                font-weight: normal;
            }
        }

        .title,
        .name,
        .seat,
        .time {
            text-transform: uppercase;
            font-weight: normal;

            h2 {
                font-size: 1rem;
                color: #525252;
                font-weight: bold;
                margin: 0;
            }

            span {
                font-size: .7em;
                color: #a2aeae;
            }
        }

        .title {
            margin: 2em 0 0 0;
        }

        .name,
        .seat {
            margin: .7em 0 0 0;
        }

        .time {
            margin: .7em 0 0 1em;
        }

        .seat,
        .time {
            float: left;
        }

        .number {
            text-align: center;
            text-transform: uppercase;

            h3 {
                color: #e84c3d;
                margin: .9em 0 0 0;
                font-size: 2.5em;

            }

            span {
                display: block;
                color: #a2aeae;
            }
        }

        .barcode {
            height: 2em;
            width: 0;
            margin: 1.2em 0 0 .8em;
            box-shadow: 1px 0 0 1px #343434,
                5px 0 0 1px #343434,
                10px 0 0 1px #343434,
                11px 0 0 1px #343434,
                15px 0 0 1px #343434,
                18px 0 0 1px #343434,
                22px 0 0 1px #343434,
                23px 0 0 1px #343434,
                26px 0 0 1px #343434,
                30px 0 0 1px #343434,
                35px 0 0 1px #343434,
                37px 0 0 1px #343434,
                41px 0 0 1px #343434,
                44px 0 0 1px #343434,
                47px 0 0 1px #343434,
                51px 0 0 1px #343434,
                56px 0 0 1px #343434,
                59px 0 0 1px #343434,
                64px 0 0 1px #343434,
                68px 0 0 1px #343434,
                72px 0 0 1px #343434,
                74px 0 0 1px #343434,
                77px 0 0 1px #343434,
                81px 0 0 1px #343434;
        }
    </style>
</div>
