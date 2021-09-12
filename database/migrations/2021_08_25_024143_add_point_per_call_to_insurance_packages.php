<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPointPerCallToInsurancePackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_packages', function (Blueprint $table) {
            $table->integer('point_per_call')->nullable()->after('terms_url');
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
            $table->dropColumn('point_per_call');
        });
    }
}
