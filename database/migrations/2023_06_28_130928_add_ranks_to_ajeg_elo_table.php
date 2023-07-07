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
        Schema::table('elo', function (Blueprint $table) {
            $table->integer('rank')->nullable();
            $table->integer('old_rank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('elo', function (Blueprint $table) {
            $table->integer('rank');
            $table->integer('old_rank');
        });
    }
};
