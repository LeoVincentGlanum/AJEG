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
        Schema::create('ajeg_bets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_id')->constrained('ajeg_games')->references('id')->onDelete('cascade');
            $table->foreignId('gambler_id')->constrained('ajeg_users')->references('id');
            $table->foreignId('gameplayer_id')->constrained('ajeg_game_players')->references('id');
            $table->integer('bet_deposit');
            $table->integer('bet_gain');
            $table->string('bet_status');
            $table->timestamps();
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
        Schema::dropIfExists('ajeg_bets');
    }
};
