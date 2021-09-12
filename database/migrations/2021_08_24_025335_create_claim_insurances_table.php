<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claim_insurances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('enroll_id');
            $table->string('insurance_type')->nullable();
            $table->string('claim_type')->nullable();
            $table->string('member_id')->nullable();
            $table->string('insured_name')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('org_name')->nullable();
            $table->string('org_mobile')->nullable();
            $table->string('org_mobile_alt')->nullable();
            $table->string('relation_with_insured')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('hospital_area')->nullable();
            $table->string('admission_date')->nullable();
            $table->string('discharge_date')->nullable();
            $table->string('accommodation_charge')->nullable();
            $table->string('doctor_fee')->nullable();
            $table->string('test_cost')->nullable();
            $table->string('medicine_cost')->nullable();
            $table->string('surgical_cost')->nullable();
            $table->string('ancillary_fee')->nullable();
            $table->string('other_expenses')->nullable();
            $table->string('discount')->nullable();
            $table->string('claim_amount')->nullable();
            $table->string('ac_name')->nullable();
            $table->string('ac_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('routing_number')->nullable();
            $table->boolean('is_checked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('claim_insurances');
    }
}
