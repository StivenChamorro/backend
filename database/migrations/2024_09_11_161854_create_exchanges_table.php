<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('children_id')->references('id')->on('childrens');
            $table->foreignId('article_id')->references('id')->on('articles');
            $table->timestamps();
        });
        DB::table('exchanges')->insert([
            ['description' => 'Canje 1' , 'children_id' => 1 , 'article_id' => 1 ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchanges');
    }
};
