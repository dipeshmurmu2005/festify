<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EventCategorySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            [
                'name' => 'Music & Concerts',
                'icon' => 'heroicon-o-musical-note',
                'description' => 'Shows, gigs, and performances',
            ],
            [
                'name' => 'Tech & Conferences',
                'icon' => 'heroicon-o-computer-desktop',
                'description' => 'Talks, summits, and tech meetups',
            ],
            [
                'name' => 'Workshops',
                'icon' => 'heroicon-o-academic-cap',
                'description' => 'Hands-on learning sessions',
            ],
            [
                'name' => 'Sports & Fitness',
                'icon' => 'heroicon-o-trophy',
                'description' => 'Games, training, and competitions',
            ],
            [
                'name' => 'Art & Culture',
                'icon' => 'heroicon-o-paint-brush',
                'description' => 'Exhibitions, culture, and creativity',
            ],
            [
                'name' => 'Food & Drinks',
                'icon' => 'heroicon-o-cake',
                'description' => 'Food fests and tasting events',
            ],
            [
                'name' => 'Business & Networking',
                'icon' => 'heroicon-o-briefcase',
                'description' => 'Meet, pitch, and collaborate',
            ],
            [
                'name' => 'Community & Social',
                'icon' => 'heroicon-o-users',
                'description' => 'Social and community gatherings',
            ],
            [
                'name' => 'Health & Wellness',
                'icon' => 'heroicon-o-heart',
                'description' => 'Mind, body, and wellness events',
            ],
            [
                'name' => 'Education',
                'icon' => 'heroicon-o-book-open',
                'description' => 'Learning and academic events',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('event_categories')->updateOrInsert(
                ['name' => $category['name']],
                [
                    'icon' => $category['icon'],
                    'description' => $category['description'],
                    'is_new' => [true, false][rand(0, 1)],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
