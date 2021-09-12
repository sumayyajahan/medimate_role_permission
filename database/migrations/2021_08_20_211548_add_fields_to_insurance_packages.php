<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToInsurancePackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_packages', function (Blueprint $table) {
            $table->string('video_call')->nullable()->after('duration');
            $table->string('diagnostic_discount')->nullable()->after('video_call');
            $table->string('insurance')->nullable()->after('diagnostic_discount');
            $table->string('emergency_medical')->nullable()->after('insurance');
            $table->string('hospitalization')->nullable()->after('emergency_medical');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_packages', function (Blueprint $table) {
            $table->dropColumn('video_call');
            $table->dropColumn('diagnostic_discount');
            $table->dropColumn('insurance');
            $table->dropColumn('emergency_medical');
            $table->dropColumn('hospitalization');
        });
    }
}
