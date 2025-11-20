<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_relationships', function (Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('user_related_id')->unique();
            $table->foreign('user_related_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('user_relationship_tokens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('token', 6);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');           
            $table->datetime('expires_at');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_relationships');
        Schema::dropIfExists('user_relationship_tokens');
    }
};
