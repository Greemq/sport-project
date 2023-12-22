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
        Schema::table('athletes', function (Blueprint $table) {
            $table->dropColumn('accepted');
            $table->string('personal_id')->change();
        });

        Schema::table('athlete_calendar_results', function (Blueprint $table) {
            $table->boolean('accepted')->nullable();
            $table->dropTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('athletes', function (Blueprint $table) {
            $table->boolean('accepted')->nullable();
            $table->unsignedBigInteger('personal_id')->change();
        });
        Schema::table('athlete_calendar_results', function (Blueprint $table) {
            $table->dropColumn('accepted');
            $table->timestamps();
        });
    }
};
