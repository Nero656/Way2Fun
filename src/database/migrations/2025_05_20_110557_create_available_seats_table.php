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
        Schema::create('available_seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');
            $table->integer('activity_date_id');
            $table->integer('available_seats');
            $table->timestamps();

            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('activity_date_id')->references('id')->on('activity_dates');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_seats');
    }
};
