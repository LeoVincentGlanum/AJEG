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
        Schema::dropIfExists('user_notifications');
        Schema::dropIfExists('notifications');

        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
            $table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('notifications');

         Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator')
                ->constrained('users');
            $table->string('type');
            $table->text('message');
            $table->timestamps();
        });

          Schema::create('user_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')
                ->constrained('notifications')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained('users');
            $table->boolean('is_done');
            $table->timestamps();
        });
    }
};
