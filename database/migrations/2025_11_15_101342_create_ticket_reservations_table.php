<?php

use App\Enums\TicketReservationStatusEnum;
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
        Schema::create('ticket_reservations', function (Blueprint $table) {
            $table->id();

            $table->json('guest_user_info')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('reservation_code')->nullable()->unique();

            $table->unsignedBigInteger('event_id');

            $table->unsignedBigInteger('event_session_id')->nullable();

            $table->string('status')->default(TicketReservationStatusEnum::ACTIVE->value);

            $table->timestamp('expires_at');

            $table->decimal('total_amount', 12, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_reservations');
    }
};
