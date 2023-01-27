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
        Schema::create('ajeg_tournaments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizer_id')->constrained('ajeg_users');
            $table->string('name');
            $table->integer('number_of_players');
            $table->integer('entrance_fee');
            $table->foreignId('game_type_id')->constrained('ajeg_game_types');
            $table->boolean('notification')->default(false);
            $table->string('type');
            $table->string('elo_min')->nullable();
            $table->string('elo_max')->nullable();
            $table->string('status');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->foreignId('winner_id')->nullable()->constrained('ajeg_users');
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
        Schema::dropIfExists('ajeg_tournaments');
    }
};
