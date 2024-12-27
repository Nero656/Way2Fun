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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('short_description');
            $table->float('price');
            $table->integer('duration'); // Duration in minutes
            $table->integer('capacity'); // Maximum participants

            $table->unsignedInteger('guide_id');
            $table->unsignedInteger('city_id');
            $table->unsignedInteger('category_id');
            $table->timestamps();

            $table->foreign('guide_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')
                ->on('cities')->onDelete('cascade');
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
