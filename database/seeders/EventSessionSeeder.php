<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EventSessionSeeder extends Seeder
{
    public function run(): void
    {
        $events = DB::table('events')->get();
        $now = Carbon::now();

        foreach ($events as $event) {

            /**
             * SINGLE DAY EVENT
             */
            if (!$event->is_multi_session_event || $event->schedule_type === 'across days') {

                DB::table('event_sessions')->updateOrInsert(
                    [
                        'event_id' => $event->id,
                        'date' => Carbon::parse($event->event_date)->toDateString(),
                    ],
                    [
                        'organizer_id' => $event->organizer_id,
                        'time' => '10:00 AM - 05:00 PM',
                        'ticket_adjustment' => 0,
                        'label' => 'Main Session',
                        'capacity_override' => $event->venue_capacity_override,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );

                continue;
            }

            /**
             * MULTI-SESSION (DATE RANGE)
             */
            $start = Carbon::parse($event->event_date);
            $end   = Carbon::parse($event->end_date);

            $day = 1;

            while ($start->lte($end)) {

                DB::table('event_sessions')->updateOrInsert(
                    [
                        'event_id' => $event->id,
                        'date' => $start->toDateString(),
                    ],
                    [
                        'organizer_id' => $event->organizer_id,
                        'time' => '11:00 AM - 08:00 PM',
                        'ticket_adjustment' => rand(0, 300),
                        'label' => 'Day ' . $day,
                        'capacity_override' => $event->venue_capacity_override,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );

                $start->addDay();
                $day++;
            }
        }
    }
}
