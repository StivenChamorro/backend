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
        Schema::create('image__users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exchange_id')->references('id')->on('exchanges')->onDelete('cascade');
            $table->string('url_imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image__users');
    }
};
