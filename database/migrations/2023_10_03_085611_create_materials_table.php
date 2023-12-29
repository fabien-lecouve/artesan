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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
	        $table->foreignId('category_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->string('description');
            $table->string('start_of_description_for_several')->nullable();
            $table->string('end_of_description_for_several')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
