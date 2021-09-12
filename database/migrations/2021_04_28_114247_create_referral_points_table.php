<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_refer_to')->default(5);
            $table->integer('user_refer_by')->default(5);
            $table->integer('doctor_refer_to')->default(5);
            $table->integer('doctor_refer_by')->default(5);
            $table->integer('service_refer_to')->default(5);
            $table->integer('service_refer_by')->default(5);
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
        Schema::dropIfExists('referral_points');
    }
}
