<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToReferralHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referral_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('doctor_refer_by')->nullable();

            $table->unsignedBigInteger('service_provider_id')->nullable();
            $table->unsignedBigInteger('service_provider_refer_by')->nullable();

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('doctor_refer_by')->references('id')->on('doctors')->onDelete('cascade');

            $table->foreign('service_provider_id')->references('id')->on('service_providers')->onDelete('cascade');
            $table->foreign('service_provider_refer_by')->references('id')->on('service_providers')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referral_histories', function (Blueprint $table) {
            //
        });
    }
}
