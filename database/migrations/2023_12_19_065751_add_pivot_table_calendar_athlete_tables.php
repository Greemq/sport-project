<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('athlete_calendar_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calendar_results_id');
            $table->unsignedBigInteger('athlete_id');
            $table->timestamps();
            $table->foreign('calendar_results_id')->references('id')->on('calendar_results')->onDelete('CASCADE');
            $table->foreign('athlete_id')->references('id')->on('calendar_results')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athlete_calendar_results');
    }
};
