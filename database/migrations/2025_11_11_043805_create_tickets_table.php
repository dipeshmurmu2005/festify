<?php

use App\Enums\TicketStatusEnum;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('type');
            $table->string('title');
            $table->string('minimum_order_quantity');
            $table->string('maximum_order_quantity');
            $table->decimal('base_price', 10, 2)->nullable();
            $table->dateTime('sales_starts_at');
            $table->dateTime('sales_ends_at');
            $table->json('aminities');
            $table->string('capacity_type');
            $table->integer('capacity')->nullable();
            $table->string('status')->default(TicketStatusEnum::INACTIVE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
