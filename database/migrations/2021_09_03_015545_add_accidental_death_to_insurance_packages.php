<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccidentalDeathToInsurancePackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_packages', function (Blueprint $table) {
            $table->string('accidental_death')->after('hospitalization')->nullable();
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
            $table->dropColumn('accidental_death');
        });
    }
}
