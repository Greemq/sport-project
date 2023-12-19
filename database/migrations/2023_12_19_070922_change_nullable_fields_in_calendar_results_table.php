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
        Schema::table('calendar_results', function (Blueprint $table) {
            $table->string('state')->nullable()->change();
            $table->string('protocol')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calendar_results', function (Blueprint $table) {
            $table->string('state')->nullable(false)->change();
            $table->string('protocol')->nullable(false)->change();
        });
    }
};
