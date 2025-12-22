<?php

use App\Enums\EventStatusEnum;
use App\Enums\VisibilityTypeEnum;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('organizer_id');
            $table->string('title');
            $table->string('organizer_name');
            $table->boolean('is_multi_session_event')->default(false);
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('event_category_id')->nullable();
            $table->string('cover_image');

            $table->string('venue_name')->nullable();
            $table->string('venue_address')->nullable();
            $table->integer('venue_capacity_override')->nullable();
            $table->string('venue_latitude')->nullable();
            $table->string('venue_longitude')->nullable();

            $table->string('schedule_type');
            $table->dateTime('event_date')->nullable();
            $table->dateTime('end_date')->nullable();

            $table->string('status')->default(EventStatusEnum::Draft);

            $table->string('visibility_type')->default(VisibilityTypeEnum::Private);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
