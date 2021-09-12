<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceEnrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_enrolls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('insurance_id');
            $table->unsignedBigInteger('insurance_package_id');
            $table->unsignedBigInteger('user_id');
            $table->string('type')->comment("LifeTerm or ShortTerm");
            $table->string('comment')->nullable();
            $table->tinyInteger('status')->default(0)->comment("0->Applied, 1->Admin Accepted, 2->Admin Reject, 9->Canceled By User");
            $table->tinyInteger('is_approved')->default(0)->comment("0->Pending for Company Proceeding, 1->Company Accepted, 2-> Company Reject, 9->Canceled By Company upon User Request");
            $table->foreign('insurance_id')->references('id')->on('insurances')->onDelete('cascade');
            $table->foreign('insurance_package_id')->references('id')->on('insurance_packages')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('insurance_enrolls');
    }
}
