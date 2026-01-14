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
        Schema::table('kuliners', function (Blueprint $table) {
            $table->integer('rasa')->default(5);
            $table->integer('populer')->default(5);
            $table->integer('gizi')->default(5);
            $table->integer('biaya')->default(50000);
            $table->integer('porsi')->default(5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kuliners', function (Blueprint $table) {
            $table->dropColumn(['rasa', 'populer', 'gizi', 'biaya', 'porsi']);
        });
    }
};
