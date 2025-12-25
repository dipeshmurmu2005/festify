<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpenseCategorySeeder extends Seeder
{
    public function run(): void
    {
        // Optional: uncomment if you want a clean reset
        // DB::table('event_expense_categories')->truncate();

        $now = Carbon::now();

        $categories = [
            // Venue & logistics
            ['name' => 'Venue Rent', 'icon' => 'heroicon-o-building-storefront'],
            ['name' => 'Stage & Setup', 'icon' => 'heroicon-o-squares-plus'],
            ['name' => 'Seating & Furniture', 'icon' => 'heroicon-o-table-cells'],
            ['name' => 'Power & Electricity', 'icon' => 'heroicon-o-bolt'],
            ['name' => 'Water & Utilities', 'icon' => 'heroicon-o-beaker'],
            ['name' => 'Transportation & Logistics', 'icon' => 'heroicon-o-truck'],

            // Marketing & promotion
            ['name' => 'Marketing & Promotion', 'icon' => 'heroicon-o-megaphone'],
            ['name' => 'Social Media Ads', 'icon' => 'heroicon-o-share'],
            ['name' => 'Print & Banners', 'icon' => 'heroicon-o-printer'],
            ['name' => 'Influencer / Media Promotion', 'icon' => 'heroicon-o-video-camera'],

            // Talent & staff
            ['name' => 'Artist / Performer Fees', 'icon' => 'heroicon-o-musical-note'],
            ['name' => 'Speaker Fees', 'icon' => 'heroicon-o-microphone'],
            ['name' => 'Staff & Volunteers', 'icon' => 'heroicon-o-users'],
            ['name' => 'Security Services', 'icon' => 'heroicon-o-shield-check'],
            ['name' => 'Event Management Team', 'icon' => 'heroicon-o-briefcase'],

            // Equipment & production
            ['name' => 'Sound System', 'icon' => 'heroicon-o-speaker-wave'],
            ['name' => 'Lighting Equipment', 'icon' => 'heroicon-o-light-bulb'],
            ['name' => 'Audio / Visual Equipment', 'icon' => 'heroicon-o-tv'],
            ['name' => 'Camera & Recording', 'icon' => 'heroicon-o-camera'],

            // Guest experience
            ['name' => 'Food & Catering', 'icon' => 'heroicon-o-cake'],
            ['name' => 'Beverages', 'icon' => 'hugeicons-drink'],
            ['name' => 'Accommodation', 'icon' => 'heroicon-o-home'],
            ['name' => 'Guest Gifts & Merchandise', 'icon' => 'heroicon-o-gift'],

            // Tickets & tech
            ['name' => 'Ticketing Platform Fees', 'icon' => 'heroicon-o-ticket'],
            ['name' => 'Payment Gateway Charges', 'icon' => 'heroicon-o-credit-card'],
            ['name' => 'Website / App Development', 'icon' => 'heroicon-o-code-bracket'],
            ['name' => 'Software & Tools', 'icon' => 'heroicon-o-cog-6-tooth'],

            // Legal & admin
            ['name' => 'Licenses & Permits', 'icon' => 'heroicon-o-document-check'],
            ['name' => 'Insurance', 'icon' => 'heroicon-o-clipboard-document-check'],
            ['name' => 'Legal & Compliance', 'icon' => 'heroicon-o-scale'],

            // Misc
            ['name' => 'Travel Expenses', 'icon' => 'heroicon-o-map'],
            ['name' => 'Emergency / Contingency', 'icon' => 'heroicon-o-exclamation-triangle'],
            ['name' => 'Miscellaneous', 'icon' => 'heroicon-o-ellipsis-horizontal'],
        ];

        foreach ($categories as $category) {
            DB::table('event_expense_categories')->insert([
                'name'       => $category['name'],
                'icon'       => $category['icon'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
