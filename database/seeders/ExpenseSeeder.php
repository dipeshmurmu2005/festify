<?php

namespace Database\Seeders;

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventExpenseCategory;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $categories = EventExpenseCategory::all();

        if ($categories->isEmpty()) {
            $this->command->warn('No expense categories found. Run ExpenseCategorySeeder first.');
            return;
        }

        Event::query()
            ->whereNotNull('estimated_budget')
            ->where('estimated_budget', '>', 0)
            ->chunk(50, function ($events) use ($categories, $now) {

                foreach ($events as $event) {

                    // Use 60–90% of estimated budget as expenses
                    $totalExpenseBudget = round(
                        $event->estimated_budget * rand(60, 90) / 100,
                        2
                    );

                    // Number of expense entries per event
                    $expenseCount = rand(4, 8);

                    $remainingAmount = $totalExpenseBudget;

                    for ($i = 1; $i <= $expenseCount; $i++) {

                        $category = $categories->random();

                        // Distribute amount realistically
                        $amount = ($i === $expenseCount)
                            ? $remainingAmount
                            : round(rand(5, 25) / 100 * $totalExpenseBudget, 2);

                        $remainingAmount -= $amount;

                        if ($amount <= 0) {
                            continue;
                        }

                        $paymentStatus = collect([PaymentStatusEnum::Pending->value, PaymentStatusEnum::Verified->value])->random();

                        DB::table('expenses')->insert([
                            'organizer_id'        => $event->organizer_id,
                            'event_id'            => $event->id,
                            'expense_category_id' => $category->id,
                            'title'               => $category->name . ' Expense',
                            'notes'               => 'Expense related to ' . strtolower($category->name) . ' for the event.',
                            'payee_name'          => $this->randomPayeeName(),
                            'amount'              => $amount,
                            'payment_status'      => $paymentStatus,
                            'payment_date'        => $paymentStatus === 'paid'
                                ? Carbon::now()->subDays(rand(1, 15))
                                : null,
                            'created_at'          => $now,
                            'updated_at'          => $now,
                        ]);
                    }
                }
            });
    }

    protected function randomPayeeName(): string
    {
        return collect([
            'ABC Event Services',
            'StageCraft Nepal',
            'SoundWave Productions',
            'Creative Media House',
            'Elite Security Pvt Ltd',
            'Venue Management Co.',
            'Freelance Contractor',
            'Local Supplier',
        ])->random();
    }
}
