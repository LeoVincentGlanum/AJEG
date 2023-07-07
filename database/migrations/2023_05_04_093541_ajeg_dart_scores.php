<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dart_scores', function (Blueprint $table) {
            $table->id()
                ->autoIncrement();
            $table->foreignId('dart_game_id')
                ->constrained('dart_games')
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained('users');
            $table->integer('round_1');
            $table->integer('round_2');
            $table->integer('round_3');
            $table->integer('round_4');
            $table->integer('round_5');
            $table->integer('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dart_scores');
    }
};
