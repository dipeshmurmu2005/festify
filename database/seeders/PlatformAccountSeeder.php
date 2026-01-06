<?php

namespace Database\Seeders;

use App\Models\PlatformAccount;
use Illuminate\Database\Seeder;

class PlatformAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $platform = PlatformAccount::create([
            'name' => 'Platform'
        ]);
    }
}
