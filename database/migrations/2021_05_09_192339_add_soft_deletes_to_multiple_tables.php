<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToMultipleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallet_transaction_logs', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('appointment_schedules', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('appointment_slots', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('bkash_recharge_requests', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('bulk_reschedules', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('cashouts', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('doctor_visit_charges', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('doctor_specializations', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('doctor_wallets', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('e_prescriptions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('otc_products', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('payments', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('referral_histories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('report_prescriptions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('service_provider_comissions', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('service_provider_comission_histories', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('service_provider_wallets', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('user_orders', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('wallet_transaction_logs', function (Blueprint $table) {
        //     // $table->softDeletes();
        // });
    }
}
