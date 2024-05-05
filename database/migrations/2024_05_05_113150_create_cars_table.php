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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('manufacturer');
            $table->date('release_date');
            $table->decimal('fuel_economy', 8, 2);
            $table->decimal('max_speed', 8, 2);
            $table->decimal('weight', 8, 2);
            $table->string('size');
            $table->text('misc_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_cars');
    }
};
