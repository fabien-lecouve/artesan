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
        Schema::create('location_of_works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estimate_id')->constrained();
            $table->foreignId('room_id')->constrained();
            $table->tinyInteger('warranty');
            $table->integer('supplies')->nullable();
            $table->integer('subtotal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_of_works');
    }
};
