<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToNotificationForAlls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notification_for_alls', function (Blueprint $table) {
            $table->boolean('can_access_app')->after('body')->default(true);
            $table->string('build_number')->after('can_access_app')->nullable();
            $table->boolean('has_button')->after('build_number')->default(false);
            $table->string('button_text')->after('build_number')->nullable();
            $table->string('button_url')->after('button_text')->nullable();
            $table->string('expiry_date')->after('button_url')->nullable();
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
            $table->dropColumn('can_access_app');
            $table->dropColumn('build_number');
            $table->dropColumn('has_button');
            $table->dropColumn('button_text');
            $table->dropColumn('button_url');
            $table->dropColumn('expiry_date');
        });
    }
}
