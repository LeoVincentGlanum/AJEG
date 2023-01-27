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
        Schema::table('ajeg_games', function (Blueprint $table) {
              $table->foreignId('created_by')->after('status')->constrained('ajeg_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ajeg_games', function (Blueprint $table) {
            $table->dropForeign('games_created_by_foreign');
            $table->dropColumn('created_by');
        });
    }
};
