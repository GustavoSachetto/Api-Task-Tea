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
        Schema::create('tasks', function (Blueprint $table){
            $table->id();
            $table->string('title', 70);
            $table->text('description');
            $table->string('tip', 120);
            $table->enum('level',['easy', 'medium', 'hard']);
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->UnsignedBigInteger('categories_id');
            $table->foreign('categories_id')->references('id')->on('categories');

            $table->UnsignedBigInteger('user_creator_id');
            $table->foreign('user_creator_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
