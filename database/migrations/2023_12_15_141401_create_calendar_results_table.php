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
        Schema::create('calendar_results', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->string('title');
            $table->string('state');
            $table->string('protocol');
            $table->unsignedTinyInteger('status');
            $table->string('link')->nullable();
            $table->unsignedTinyInteger('type');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_results');
    }
};
