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
            ],
            [
                'name' => 'Tech & Conferences',
                'icon' => 'heroicon-o-computer-desktop',
            ],
            [
                'name' => 'Workshops',
                'icon' => 'heroicon-o-academic-cap',
            ],
            [
                'name' => 'Sports & Fitness',
                'icon' => 'heroicon-o-trophy',
            ],
            [
                'name' => 'Art & Culture',
                'icon' => 'heroicon-o-paint-brush',
            ],
            [
                'name' => 'Food & Drinks',
                'icon' => 'heroicon-o-cake',
            ],
            [
                'name' => 'Business & Networking',
                'icon' => 'heroicon-o-briefcase',
            ],
            [
                'name' => 'Community & Social',
                'icon' => 'heroicon-o-users',
            ],
            [
                'name' => 'Health & Wellness',
                'icon' => 'heroicon-o-heart',
            ],
            [
                'name' => 'Education',
                'icon' => 'heroicon-o-book-open',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('event_categories')->updateOrInsert(
                ['name' => $category['name']],
                [
                    'icon' => $category['icon'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
