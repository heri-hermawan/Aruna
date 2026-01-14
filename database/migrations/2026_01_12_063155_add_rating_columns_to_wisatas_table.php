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
        Schema::table('wisatas', function (Blueprint $table) {
            $table->integer('daya_tarik')->default(5);
            $table->integer('populer')->default(5);
            $table->integer('harga')->default(50000);
            $table->integer('fasilitas')->default(5);
            $table->integer('kebersihan')->default(5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wisatas', function (Blueprint $table) {
            $table->dropColumn(['daya_tarik', 'populer', 'harga', 'fasilitas', 'kebersihan']);
        });
    }
};
