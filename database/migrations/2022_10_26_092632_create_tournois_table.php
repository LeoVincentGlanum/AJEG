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
        Schema::create('tournois', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->boolean('notification');
            $table->string('name');
            $table->integer('cashprize_perso')->nullable();
            $table->integer('cashprize_modo')->nullable();
            $table->boolean('cashprize_ok')->nullable();
            $table->string('status')->default('subscription');
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
        Schema::dropIfExists('tournois');
    }
};
