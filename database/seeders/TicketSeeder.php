<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $events = DB::table('events')->get();
        $now = Carbon::now();

        foreach ($events as $event) {

            $salesStart = Carbon::parse($event->event_date)->subDays(rand(20, 40));
            $salesEnd   = Carbon::parse($event->event_date)->subDays(rand(1, 3));

            $tickets = [
                [
                    'type' => 'paid',
                    'title' => 'Early Bird',
                    'base_price' => rand(300, 800),
                    'capacity_type' => 'individual',
                    'capacity' => rand(50, 200),
                ],
                [
                    'type' => 'paid',
                    'title' => 'Regular',
                    'base_price' => rand(800, 1500),
                    'capacity_type' => 'shared with venue',
                    'capacity' => null,
                ]
            ];

            foreach ($tickets as $ticket) {

                DB::table('tickets')->updateOrInsert(
                    [
                        'event_id' => $event->id,
                        'title' => $ticket['title'],
                    ],
                    [
                        'organizer_id' => $event->organizer_id,
                        'type' => $ticket['type'],
                        'minimum_order_quantity' => 1,
                        'maximum_order_quantity' => rand(2, 6),
                        'base_price' => $ticket['base_price'],
                        'sales_starts_at' => $salesStart,
                        'sales_ends_at' => $salesEnd,
                        'aminities' => json_encode([
                            'Seat access',
                            'Event entry',
                            $ticket['title'] === 'VIP / Invite' ? 'Backstage access' : 'Standard access',
                        ]),
                        'capacity_type' => $ticket['capacity_type'],
                        'capacity' => $ticket['capacity_type'] === 'individual'
                            ? $ticket['capacity']
                            : null,
                        'status' => 'active',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }
    }
}
