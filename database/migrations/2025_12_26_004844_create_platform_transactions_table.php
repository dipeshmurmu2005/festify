<?php

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

            $table->morphs('initiator');

            $table->unsignedBigInteger('organizer_id')->nullable();

            $table->morphs('beneficiary');

            $table->unsignedBigInteger('payment_id')->nullable();

            $table->string('type');

            $table->decimal('amount', 12, 2);

            $table->string('purpose');

            $table->string('status');

            $table->string('origin');

            $table->morphs('referenceable');

            $table->text('note')->nullable();

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
