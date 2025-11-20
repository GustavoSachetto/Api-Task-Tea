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
        Schema::create('task_user', function (Blueprint $table){
            $table->id();
            $table->boolean('done')->default(false);
            $table->enum('difficult_level',['very easy', 'easy', 'medium', 'hard', 'very hard'])->nullable();
            $table->datetime('finished_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('tasks_id');
            $table->foreign('tasks_id')->references('id')->on('tasks');

            $table->unsignedBigInteger('user_receiver_id');
            $table->foreign('user_receiver_id')->references('id')->on('users');

            $table->unsignedBigInteger('user_assigner_id');
            $table->foreign('user_assigner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_user');
    }
};
