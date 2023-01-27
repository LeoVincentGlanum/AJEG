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
        Schema::create('ajeg_user_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')
                ->constrained('ajeg_notifications')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained('ajeg_users');
            $table->boolean('is_done');
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
        Schema::dropIfExists('ajeg_user_notifications');
    }
};
