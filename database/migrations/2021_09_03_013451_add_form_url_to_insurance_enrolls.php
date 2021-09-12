<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormUrlToInsuranceEnrolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurance_enrolls', function (Blueprint $table) {
            $table->string('form_url')->after('activation_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurance_enrolls', function (Blueprint $table) {
            $table->dropColumn('form_url');
        });
    }
}
