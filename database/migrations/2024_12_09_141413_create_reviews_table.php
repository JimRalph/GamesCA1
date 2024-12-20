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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            //cascade means if a book is deleted it's reviews will be too
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            // if a user is deleted their reviews will be too
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('rating')->unsigned()->default(1);
            $table->text('comment')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
