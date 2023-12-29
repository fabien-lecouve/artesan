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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('customer_id')->constrained();
	        $table->foreignId('mode_of_work_id')->constrained();
            $table->foreignId('status_id')->constrained();
            $table->string('titled')->nullable();
            $table->boolean('big_construction');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('reference')->nullable()->unique();
            $table->integer('advance')->nullable();
            $table->integer('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimates');
    }
};
