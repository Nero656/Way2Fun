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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('img_url');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->timestamps();

            // Добавление внешних ключей
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');
            $table->foreign('city_id')->references('id')
                ->on('cities')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')
                ->on('activities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
