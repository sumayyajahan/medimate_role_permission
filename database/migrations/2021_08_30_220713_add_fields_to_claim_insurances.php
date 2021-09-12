<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToClaimInsurances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claim_insurances', function (Blueprint $table) {
            $table->string('signature_employee')->after('routing_number')->nullable();
            $table->string('signature_coordinator')->after('signature_employee')->nullable();
            $table->string('signature_officer')->after('signature_coordinator')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claim_insurances', function (Blueprint $table) {
            $table->dropColumn('signature_employee');
            $table->dropColumn('signature_coordinator');
            $table->dropColumn('signature_officer');
        });
    }
}
