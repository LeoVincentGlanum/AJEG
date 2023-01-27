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
        Schema::table('ajeg_users', function (Blueprint $table) {
            $table->timestamp('welcome_valid_until')->nullable()->after('admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ajeg_users', function (Blueprint $table) {
            $table->dropColumn('welcome_valid_until');
        });
    }
};
