<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $titles = [
            'Music Fest',
            'Tech Conference',
            'Startup Meetup',
            'Food Carnival',
            'Art Exhibition',
            'Health Workshop',
            'Business Summit',
            'Cultural Program',
            'Sports Tournament',
            'Education Fair',
        ];

        $venues = [
            [
                'name' => 'Tundikhel Ground',
                'address' => 'Kathmandu',
                'lat' => '27.6990',
                'lng' => '85.3001',
            ],
            [
                'name' => 'Bhrikutimandap',
                'address' => 'Kathmandu',
                'lat' => '27.6946',
                'lng' => '85.3206',
            ],
            [
                'name' => 'Hotel Yak & Yeti',
                'address' => 'Durbar Marg',
                'lat' => '27.7120',
                'lng' => '85.3175',
            ],
            [
                'name' => 'Gokarna Forest Resort',
                'address' => 'Gokarna',
                'lat' => '27.7426',
                'lng' => '85.3795',
            ],
        ];

        for ($i = 1; $i <= 30; $i++) {

            $venue = $venues[array_rand($venues)];
            $isMultiSession = rand(0, 1);

            $eventDate = Carbon::now()->addDays(rand(5, 120));
            $endDate = $isMultiSession
                ? (clone $eventDate)->addDays(rand(1, 3))
                : null;

            DB::table('events')->updateOrInsert(
                ['title' => "Event {$i} {$titles[array_rand($titles)]}"],
                [
                    'user_id' => 1,
                    'organizer_id' => 1,
                    'organizer_name' => 'Organizer ' . rand(1, 5),
                    'estimated_budget' => rand(50000, 1000000),
                    'is_multi_session_event' => $isMultiSession,
                    'short_description' => 'Short description for event ' . $i,
                    'long_description' => 'Detailed description for event ' . $i . ' including agenda, speakers, and highlights.',
                    'event_category_id' => rand(1, 10),
                    'cover_image' => 'events/event-' . rand(1, 6) . '.jpg',
                    'venue_name' => $venue['name'],
                    'venue_address' => $venue['address'],
                    'venue_capacity_override' => rand(100, 20000),
                    'venue_latitude' => $venue['lat'],
                    'venue_longitude' => $venue['lng'],
                    'schedule_type' => $isMultiSession ? 'across days' : 'single day',
                    'event_date' => $eventDate,
                    'end_date' => $endDate,
                    'status' => collect(['draft', 'published'])->random(),
                    'visibility_type' => collect(['public', 'private'])->random(),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
