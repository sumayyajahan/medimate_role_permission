<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoFieldToInsurancePackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_packages', function (Blueprint $table) {
            $table->string('hospital_discount')->after('diagnostic_discount')->nullable();
            $table->string('terms_url')->after('hospitalization')->nullable();
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
            $table->dropColumn('hospital_discount');
            $table->dropColumn('terms_url');
        });
    }
}
