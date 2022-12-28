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
        Schema::table('game_players', function (Blueprint $table) {
            $table->string('player_result_validation')->nullable();
            $table->string('player_participation_validation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_players', function (Blueprint $table) {
            $table->dropColumn('player_result_validation');
            $table->dropColumn('player_participation_validation');
        });
    }
};
