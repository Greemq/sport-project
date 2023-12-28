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
        Schema::table('video_galleries', function (Blueprint $table) {
            $table->string('img');
            $table->string('title');
            $table->text('description');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('video_galleries', function (Blueprint $table) {
            $table->dropColumn(['img', 'title', 'description', 'date']);
        });
    }
};
