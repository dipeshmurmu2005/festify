<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(WalletSeeder::class);
        $this->call(EventCategorySeeder::class);
        $this->call(EventSeeder::class);
        $this->call(EventSessionSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(FullBookingFlowSeeder::class);
        $this->call(ExpenseCategorySeeder::class);
        $this->call(ExpenseSeeder::class);
    }
}
