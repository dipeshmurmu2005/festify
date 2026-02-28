<?php

namespace Database\Seeders;

use App\Models\WithdrawalBank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawalBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            ['name' => 'Agricultural Development Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Citizens Bank International Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Everest Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Global IME Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Himalayan Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Kumari Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Laxmi Sunrise Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Machhapuchchhre Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Mega Bank Nepal Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Nabil Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Nepal Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Nepal Investment Mega Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Nepal SBI Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'NIC Asia Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'NMB Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Prabhu Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Prime Commercial Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Rastriya Banijya Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Sanima Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Siddhartha Bank Ltd.', 'max_limit' => 1000000.00],
            ['name' => 'Standard Chartered Bank Nepal Ltd.', 'max_limit' => 1000000.00],
        ];

        foreach ($banks as $bank) {
            WithdrawalBank::create($bank);
        }
    }
}
