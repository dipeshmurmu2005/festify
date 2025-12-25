<?php

use App\Enums\PlatformTransactionStatusEnum;
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
        Schema::create('platform_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('source');
            $table->decimal('amount', 15, 2);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('organizer_id')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default(PlatformTransactionStatusEnum::PENDING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platform_transactions');
    }
};
