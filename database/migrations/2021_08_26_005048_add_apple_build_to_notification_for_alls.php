<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAppleBuildToNotificationForAlls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notification_for_alls', function (Blueprint $table) {
            $table->string('apple_build')->after('build_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notification_for_alls', function (Blueprint $table) {
            $table->dropColumn('apple_build');
        });
    }
}
