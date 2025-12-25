<?php

namespace Database\Seeders;

use App\Models\Organizer;
use Illuminate\Database\Seeder;

class OrganizersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organizer::factory()->count(20)->create();
    }
}
