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
        Schema::create('booked_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organizer_id');
            $table->string('ticket_code')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger("ticket_id");
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('event_id');
            $table->string('event_session_id')->nullable();
            $table->string('event_date');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_tickets');
    }
};
