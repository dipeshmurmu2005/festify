<?php

use App\Enums\WithdrawalRequestEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizer_id');
            $table->unsignedBigInteger('approved_by')->nullable();

            $table->string('reference_no')->unique();

            $table->decimal('amount', 12, 2);
            $table->decimal('platform_fee', 12, 2)->default(0);
            $table->decimal('processing_fee', 12, 2)->default(0);
            $table->decimal('net_amount', 12, 2);
            $table->decimal('available_balance_at_request', 12, 2);

            $table->string('currency', 10)->default('NPR');

            $table->string('payment_method');
            $table->json('payment_details')->nullable();

            $table->string('status')->default(WithdrawalRequestEnum::Pending);

            $table->string('transaction_id')->nullable();

            $table->timestamp('approved_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->text('rejected_reason')->nullable();
            $table->text('note')->nullable();

            $table->ipAddress('ip_address')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawal_requests');
    }
};
