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
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('games')->references('id')->onDelete('cascade');
            $table->foreignId('gambler_id')->constrained('users')->references('id');
            $table->foreignId('gameplayer_id')->constrained('game_players')->references('id');
            $table->integer('bet_deposit');
            $table->integer('bet_gain');
            $table->string('bet_status');
            $table->timestamps();

//            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
//            $table->foreign('gambler_id')->references('id')->on('users');
//            $table->foreign('gameplayer_id')->references('id')->on('game_players');

            $table->unique(['game_id', 'gambler_id', 'gameplayer_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bets');
    }
};
