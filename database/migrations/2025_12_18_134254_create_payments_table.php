<?php

use App\Enums\PaymentStatusEnum;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('event_session_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('payment_method');
            $table->string('payer_id');
            $table->string('token');
            $table->string('status')->default(PaymentStatusEnum::Pending);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
